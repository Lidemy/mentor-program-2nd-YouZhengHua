<?php 
	require_once('conn.php'); 

	$orderList = json_decode($_POST['shoppingCart__dataList']);
	$orderTotal = $_POST['shoppingCart__total'];

	$conn->autocommit(false);
	$conn->begin_transaction();
	try{
		//新增訂單
		$stmt = $conn->prepare("INSERT INTO marin_order (order_user, order_price) VALUES (1, ?)");
		$stmt->bind_param("d", $orderTotal);

		$stmt->execute();

		$order_pid = $stmt->insert_id;
		$stmt->close();

		foreach ($orderList as $orderItem) {

			// 新增訂單明細
			$stmt = $conn->prepare("INSERT INTO marin_orderItems (order_pid, order_item_id, order_item_price, order_item_qty, order_sum) VALUES (?, ?, ?, ?, ?)");
			$order_item_id = intval($orderItem->itemId);
			$order_item_price = doubleval($orderItem->itemPrice);
			$order_item_qty = $orderItem->itemOrderQty;
			$order_sum = doubleval($orderItem->itemCost);
			$stmt->bind_param("iidid", $order_pid, $order_item_id, $order_item_price, $order_item_qty, $order_sum);
			$stmt->execute();
			$stmt->close();

			// 取得原始庫存資料
			$stmt = $conn->prepare("SELECT quantity FROM marin_items WHERE id = ? for update");
			$stmt->bind_param("i", $order_item_id);
			if($stmt->execute()){
				$sqlResult = $stmt->get_result();
				$result = $sqlResult->fetch_assoc();
				$stmt->close();

				// 判斷更新後庫存是否為負數，如為負數則取消訂單。
				if($result['quantity'] < $order_item_qty){
					$_SESSION['ERROR_MSG'] = "訂單取消，庫存數量不得為負數。";
					throw new Exception();
				}

				//更新庫存資料
				$stmt = $conn->prepare("UPDATE marin_items SET quantity = quantity - ? WHERE id = ?");
				$stmt->bind_param("ii", $order_item_qty, $order_item_id);
				$stmt->execute();
				$stmt->close();
			}
			else{
				$_SESSION['ERROR_MSG'] = "系統錯誤 : ".$stmt->error;
				$stmt->close();
				throw new Exception();
			}
		}

		$conn->commit();
		$conn->close();
		$_SESSION['MSG'] = "訂單新建完成";
		header("Location: isSuccess.php");
	}
	catch(Exception $e){
		if(!isSet($_SESSION['ERROR_MSG'])){
			$_SESSION['ERROR_MSG'] = $e->getMessage();
		}
		$conn->rollback();
		$conn->close();
		header("Location: isFail.php");
	}
	catch(Throwable $e){
		if(!isSet($_SESSION['ERROR_MSG'])){
			$_SESSION['ERROR_MSG'] = $e->getMessage();
		}
		$conn->rollback();
		$conn->close();
		header("Location: isFail.php");
		
	}
	finally{
		exit;
	}
?>