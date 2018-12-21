<?php
	require_once('conn.php');
	$commentId = $_POST['commentId'];
	$contnet = $_POST['contnet'];
	$stmt = $conn->prepare("UPDATE marin_comments SET contnet = ? WHERE id = ?");
	$stmt->bind_param("si", $contnet, $commentId);
	$stmt->execute();
	$stmt->close();
	$conn->close();

	$url = "index.php";

	header('Location: '.$url);
?>