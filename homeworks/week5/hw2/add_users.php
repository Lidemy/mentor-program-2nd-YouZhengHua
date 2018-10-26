<?php
	require_once('conn.php');
	$userAccount = $_POST['userAccount'];
	$password = $_POST['password'];
	$nickname = $_POST['nickname'];
	$sql = "INSERT INTO marin_users (username, password, nickname) VALUES ('$userAccount', '$password', '$nickname')";
	$result = $conn->query($sql);
	$conn->close();
	header('Location: index.php');
?>