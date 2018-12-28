<?php
	require_once('conn.php');
	$result["rtnCde"] = "fail";
	if(isset($_SESSION["userAccount"])){
		$commentId = "";
		$contnet = $_POST['contnet'];
		if(isset($_POST['parentId']) && $_POST['parentId'] !== ""){
			$parentId = $_POST['parentId'];
			$stmt = $conn->prepare("INSERT INTO marin_comments (crt_user, contnet, parent_id) VALUES (?, ?, ?)");
			$stmt->bind_param("ssi", $_SESSION["userAccount"], $contnet, $parentId);
			$stmt->execute();
			$commentId = $stmt->insert_id;
			$stmt->close();
		}
		else{
			$stmt = $conn->prepare("INSERT INTO marin_comments (crt_user, contnet) VALUES (?, ?)");
			$stmt->bind_param("ss", $_SESSION["userAccount"], $contnet);
			$stmt->execute();
			$commentId = $stmt->insert_id;
			$stmt->close();
		}

		$stmt = $conn->prepare("SELECT * FROM marin_comments a WHERE a.id = ?");
		$stmt->bind_param("i", $commentId);
		$stmt->execute();
		$sqlResult = $stmt->get_result();
		$result = $sqlResult->fetch_assoc();
		$stmt->close();
		$result["rtnCde"] = "success";
	}
	$conn->close();
	echo json_encode($result);
?>