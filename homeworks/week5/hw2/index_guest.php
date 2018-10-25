<link rel="stylesheet" type="text/css" href="style.css">
<div class="topBar">
	<div class="topBar__options">
		<a href="index.php">一般模式</a>
		<a href="login.php">登入</a>
		<a href="register.php">註冊</a>
	</div>
</div>
<div class="main">
	<div class="main__title">留言板</div>
	<div class="main__from">
		<form action="add_comments.php" method="POST">
			<div class="main__from-input">
				<input type="text" name="nickname" placeholder="暱稱">
			</div>
			<div class="main__from-textarea">
				<textarea name="contnet" placeholder="留言內容" width="200" height="100"></textarea>
			</div>
			<div>
				<button type="submit">留言</button>
			</div>
		</form>
	</div>
	<?php
		require_once('conn.php');
		$sql = "SELECT a.id, a.crt_time, a.contnet, CASE WHEN b.username IS NULL THEN CONCAT(a.crt_user, ' ( 遊客 ) ') ELSE b.nickname END AS crt_user FROM marin_comments a LEFT JOIN marin_users b ON a.crt_user = b.username WHERE parent_id IS NULL ORDER BY crt_time DESC";
		$result = $conn->query($sql);
		$pages = ceil($result->num_rows / 10);
		$index = 0;
		while($row = $result->fetch_assoc()) {
			$index++;
			$page = ceil($index / 10);
	?>
	<input type="hidden" id="pages" value="<?php echo $pages; ?>">
	<div class="main__comment <?php echo 'main__comment-page'.$page; ?>">
		<?php
			require('get_comments.php');
		?>
		<div class="main__subfrom">
			<form action="add_comments.php" method="POST">
				<div class="main__subfrom-input">
					<input type="text" name="nickname" placeholder="暱稱">
				</div>
				<div class="main__subfrom-textarea">
					<textarea name="contnet" placeholder="留言內容" width="200" height="100"></textarea>
				</div>
				<div>
					<button type="submit">留言</button>
				</div>
				<input type="hidden" name="parentId" value="<?php echo $row['id']; ?>">
			</form>
		</div>
	</div>
	<?php
		}
		$conn->close();
	?>
	<div class="main__page">
	</div>
</div>
<script src="myJS.js"></script>