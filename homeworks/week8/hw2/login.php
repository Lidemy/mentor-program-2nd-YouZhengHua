<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Signin Template for Bootstrap</title>

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
			$row = $result->fetch_assoc();
			$dbPassword = $row['password'];
			if(password_verify($password, $dbPassword)){

				$_SESSION["userAccount"] = $row['username'];
				$_SESSION["nickname"] = (!isset($row['nickname']) || $row['nickname'] === "") ? $row['username'] : $row['nickname'];

				header('Location: index.php');
			}
			else{
				$errMsg = "密碼錯誤";
			}
		}
		else{
			$errMsg = "無此帳號";
		}
		$conn->close();
	}
?>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<header>
	<nav class="navbar navbar-expand navbar-dark fixed-top bg-dark">
		<ul class="navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="index.php">留言板</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="register.php">註冊</a>
			</li>
		</ul>
	</nav>
</header>

<div class="container haveNavbar">
	<div class="row">
		<div class="col-6 mx-auto text-center">
			<h1 class="h3 mb-3 font-weight-normal">登入</h1>
			<div class="main__from">
				<?php
					if($errMsg !== ""){
				?>
						<div class="alert alert-danger" role="alert"><?php echo $errMsg; ?></div>
				<?php
					}
				?>
				<form method="POST">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">帳號</span>
						</div>
						<input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="userAccount">
					</div>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">密碼</span>
						</div>
						<input type="password" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="password">
					</div>
					<button class="btn btn-primary .btn-lg mt-3" type="submit">登入</button>
				</form>
			</div>
		</div>
	</div>
</div>