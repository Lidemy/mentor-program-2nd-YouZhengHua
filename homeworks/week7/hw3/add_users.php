<?php
	require_once('conn.php');
	$userAccount = $_POST['userAccount'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$nickname = $_POST['nickname'];
	$stmt = $conn->prepare("INSERT INTO marin_users (username, password, nickname) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $userAccount, $password, $nickname);
	$stmt->execute();
	$stmt->close();
	$conn->close();
	header('Location: index.php');
?>