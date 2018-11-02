<?php
	require_once('conn.php');
	$commentId = $_POST['commentId'];
	$stmt = $conn->prepare("DELETE FROM marin_comments WHERE id = ? OR parent_id = ?");
	$stmt->bind_param("ii", $commentId, $commentId);
	$stmt->execute();
	$stmt->close();
	$conn->close();

	$url = "index.php";

	header('Location: '.$url);
?>