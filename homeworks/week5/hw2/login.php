<?php
	require_once('conn.php');
	$errMsg = "";
	if(isset($_POST['userAccount']) && isset($_POST['password'])){
		$userAccount = $_POST['userAccount'];
		$password = $_POST['password'];
		$sql = "SELECT * FROM marin_users WHERE username = '$userAccount' AND password = '$password'";
		$result = $conn->query($sql);
		$conn->close();
		if($result->num_rows === 1){
			// 設定一個 24 小時之後會過期的 Cookie
			while($row = $result->fetch_assoc()) {
				setcookie("userAccount", $row['username'], time()+3600*24);
				setcookie("nickname", $row['nickname'], time()+3600*24);
				header('Location: index.php');
			}
		}
		else{
			$errMsg = "帳號或密碼錯誤";
		}
	}
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div class="topBar">
	<div class="topBar__options">
		<a href="index.php">留言板</a>
		<a href="register.php">註冊</a>
	</div>
</div>
<div class="main main-small">
	<div class="main__title">登入</div>
	<div class="main__from">
		<?php
			if($errMsg !== ""){
				echo $errMsg;
			}
		?>
		<form method="POST">
			<div class="main__from-input-small">
				帳號：<input type="text" name="userAccount">
			</div>
			<div class="main__from-input-small">
				密碼：<input type="password" name="password">
			</div>
			<div>
				<button type="submit">留言</button>
			</div>
		</form>
	</div>
</div>