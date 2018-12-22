<?php
	require_once('conn.php');
	$tmpId = $_COOKIE["tmpId"];
	$postId = $_POST['commentId'];

	$stmt = $conn->prepare("SELECT c.id FROM marin_users_certificate a JOIN marin_users b ON a.username = b.username JOIN marin_comments c ON c.crt_user = b.username AND c.id = ?  WHERE a.id = ?");
	$stmt->bind_param("is", $postId, $tmpId);
	if($stmt->execute()){
		$certificate = $stmt->get_result();
		$stmt->close();

		$certificateRow = $certificate->fetch_assoc();
		$commentId = $certificateRow['id'];
		$contnet = $_POST['contnet'];
		$stmt = $conn->prepare("UPDATE marin_comments SET contnet = ? WHERE id = ?");
		$stmt->bind_param("si", $contnet, $commentId);
		$stmt->execute();
		$stmt->close();
	}
	else{
		$stmt->close();
	}
	$conn->close();

	$url = "index.php";

	header('Location: '.$url);
?>