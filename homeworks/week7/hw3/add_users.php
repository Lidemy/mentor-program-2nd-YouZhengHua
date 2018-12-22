<?php
	require_once('conn.php');
	$userAccount = $_POST['userAccount'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$nickname = $_POST['nickname'];
	$stmt = $conn->prepare("INSERT INTO marin_users (username, password, nickname) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $userAccount, $password, $nickname);
	if($stmt->execute()){
		$tmpId = password_hash(uniqid(rand(mt_srand((double)microtime()*10000)), true), PASSWORD_DEFAULT);

		// 新增新的 session id
		$stmt = $conn->prepare("INSERT INTO marin_users_certificate (id, username) VALUES (?, ?)");
		$stmt->bind_param("ss", $tmpId, $userAccount);
		$stmt->execute();
		$stmt->close();

		setcookie("tmpId", $tmpId, time()+3600*24);
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