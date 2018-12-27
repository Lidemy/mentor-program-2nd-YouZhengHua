<?php
	require_once('conn.php');
	$orderPid = $_GET['orderPid'];
	$stmt = $conn->prepare("SELECT a.order_item_price, a.order_item_qty, a.order_sum, b.item_name FROM marin_orderItems a JOIN marin_items b ON b.id = a.order_item_id WHERE a.order_pid = ?");
	$stmt->bind_param("i", $orderPid);
	$stmt->execute();
	$sqlResult = $stmt->get_result();
	$dataList = array();
	while($row = $sqlResult->fetch_assoc()){
		array_push($dataList, $row);
	}
	$result['dataList'] = $dataList;	
	$result['rtnCde'] = 'success';
	echo json_encode($result);
?>