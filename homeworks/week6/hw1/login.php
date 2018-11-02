<?php
	require_once('conn.php');
	$errMsg = "";
	if(isset($_POST['userAccount']) && isset($_POST['password'])){
		$userAccount = $_POST['userAccount'];
		$password = $_POST['password'];
		$stmt = $conn->prepare("SELECT * FROM marin_users WHERE username = ?");
		$stmt->bind_param("s", $userAccount);
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		if($result->num_rows === 1){
			// 設定一個 24 小時之後會過期的 Cookie
			while($row = $result->fetch_assoc()) {
				$dbPassword = $row['password'];
				if(password_verify($password, $dbPassword)){
    				mt_srand((double)microtime()*10000);
					$tmpId = password_hash(uniqid(rand(), true), PASSWORD_DEFAULT);
					$username = $row['username'];

					// 先刪除舊有的 session id
					$stmt = $conn->prepare("DELETE FROM marin_users_certificate WHERE username = ?");
					$stmt->bind_param("s", $username);
					$stmt->execute();
					$stmt->close();

					// 再新增新的 session id
					$stmt = $conn->prepare("INSERT INTO marin_users_certificate (id, username) VALUES (?, ?)");
					$stmt->bind_param("ss", $tmpId, $username);
					$stmt->execute();
					$stmt->close();

					setcookie("tmpId", $tmpId, time()+3600*24);
					header('Location: index.php');
				}
				else{
					$errMsg = "密碼錯誤";
				}
			}
		}
		else{
			$errMsg = "無此帳號";
		}
		$conn->close();
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
				<button type="submit">登入</button>
			</div>
		</form>
	</div>
</div>