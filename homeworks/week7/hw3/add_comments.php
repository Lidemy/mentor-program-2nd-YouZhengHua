<?php
	require_once('conn.php');
	$tmpId = "";
	if(isset($_COOKIE['tmpId'])){
		$tmpId = $_COOKIE['tmpId'];
	}
	$contnet = $_POST['contnet'];
	$sql = "";
	$commentId = "";
	if(isset($_POST['parentId']) && $_POST['parentId'] !== ""){
		$parentId = $_POST['parentId'];
		$stmt = $conn->prepare("INSERT INTO marin_comments (crt_user, contnet, parent_id) SELECT b.username AS crt_user, ? AS contnet, ? AS parent_id FROM marin_users_certificate a JOIN marin_users b ON a.username = b.username WHERE a.id = ?");
		$stmt->bind_param("sis", $contnet, $parentId, $tmpId);
		$stmt->execute();
		$commentId = $stmt->insert_id;
		$stmt->close();
	}
	else{
		$stmt = $conn->prepare("INSERT INTO marin_comments (crt_user, contnet) SELECT b.username AS crt_user, ? AS contnet FROM marin_users_certificate a JOIN marin_users b ON a.username = b.username WHERE a.id = ?");
		$stmt->bind_param("ss", $contnet, $tmpId);
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
	$conn->close();
	$result["rtnCde"] = "success";
	echo json_encode($result);
?>