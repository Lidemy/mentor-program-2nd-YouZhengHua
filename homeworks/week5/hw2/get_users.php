<?php
	require_once('conn.php');
	$userAccount = $_POST['userAccount'];
	$password = $_POST['password'];
	$sql = "SELECT * FROM marin_users WHERE username = '$userAccount' AND password = '$password'";
	$result = $conn->query($sql);
	$conn->close();
	if($result->num_rows === 1){
		// 設定一個 24 小時之後會過期的 Cookie
		while($row = $result->fetch_assoc()) {
			setcookie("userAccount", $row['username'], time()+3600*24);
			header('Location: index.php');
		}
	}
	else{
		header('Location: login.php');
	}
?>