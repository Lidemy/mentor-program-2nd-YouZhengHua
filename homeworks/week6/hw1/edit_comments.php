<?php
	require_once('conn.php');
	$commentId = $_POST['commentId'];
	$contnet = str_replace("'", "\"", $_POST['contnet']);
	$sql = "UPDATE marin_comments SET contnet = '$contnet' WHERE id = '$commentId'";
	$result = $conn->query($sql);
	$conn->close();
	$url = "index.php";
	header('Location: '.$url);
?>