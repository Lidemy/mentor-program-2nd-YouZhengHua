<?php
	require_once('conn.php');
	$userAccount = $_POST['userAccount'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$nickname = $_POST['nickname'];
	$stmt = $conn->prepare("INSERT INTO marin_users (username, password, nickname) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $userAccount, $password, $nickname);
	if($stmt->execute()){

		$_SESSION["userAccount"] = $userAccount;
		$_SESSION["nickname"] = (!isset($nickname) || $nickname === "") ? $userAccount : $nickname;

		header('Location: index.php');
	}
	else{
		$errMsg = "註冊失敗";
		setcookie("errMsg", $errMsg);
		header('Location: register.php');
	}
	$stmt->close();
	$conn->close();
?>