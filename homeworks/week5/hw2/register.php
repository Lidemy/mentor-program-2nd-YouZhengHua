<link rel="stylesheet" type="text/css" href="style.css">
<div class="topBar">
	<div class="topBar__options">
		<a href="index.php">留言板</a>
		<a href="login.php">登入</a>
	</div>
</div>
<div class="main main-small">
	<div class="main__title">註冊</div>
	<div class="main__from">
		<form action="add_users.php" method="POST">
			<div class="main__from-input-small">
				帳號：<input type="text" name="userAccount">
			</div>
			<div class="main__from-input-small">
				密碼：<input type="password" name="password">
			</div>
			<div class="main__from-input-small">
				暱稱：<input type="text" name="nickname">
			</div>
			<div>
				<button type="submit">註冊</button>
			</div>
		</form>
	</div>
</div>