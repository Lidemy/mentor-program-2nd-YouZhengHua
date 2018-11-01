<?php
	require_once('conn.php');
	$commentId = $_POST['commentId'];
	$sql = "DELETE FROM marin_comments WHERE id IN ( SELECT * FROM (SELECT id FROM marin_comments WHERE id = '$commentId' OR parent_id = '$commentId') p )";
	$conn->query($sql);
	$conn->close();

	$url = "index.php";

	header('Location: '.$url);
?>