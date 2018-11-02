<?php 
	require_once('conn.php');
	$userAccount = "";
	$nickname = "";
	if(isset($_COOKIE["tmpId"])) {
		$tmpId = $_COOKIE["tmpId"];
		$stmt = $conn->prepare("SELECT b.* FROM marin_users_certificate a JOIN marin_users b ON a.username = b.username WHERE a.id = ?");
		$stmt->bind_param("s", $tmpId);
		$stmt->execute();
		$certificate = $stmt->get_result();
		$stmt->close();
		if($certificate->num_rows === 1){
			while($certificateRow = $certificate->fetch_assoc()) {
				$userAccount = $certificateRow['username'];
				$nickname = $certificateRow['nickname'];
			}
		}
	}
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div class="topBar">
	<div class="topBar__options">
		<?php 
			if($userAccount === "") {
		?>
				<a href="login.php">登入</a>
				<a href="register.php">註冊</a>
		<?php
			} else {
		?>
				<a href="logout.php">登出</a>
		<?php
			}
		?>
	</div>
</div>
<div class="main">
	<div class="main__title">留言板</div>
	<div class="main__from">
		<form action="add_comments.php" method="POST">
			<div class="main__nickname">
				<?php echo $userAccount === "" ? "請先登入" : $nickname; ?>
			</div>
			<div class="main__content">
				<textarea name="contnet" placeholder="留言內容"></textarea>
			</div>
			<div>
				<?php 
					if($userAccount === "") {
				?>
						<button type="submit" disabled="true">請先登入</button>
				<?php
					} else {
				?>
						<button type="submit">留言</button>
				<?php
					}
				?>
			</div>
		</form>
	</div>
	<?php
		$stmt = $conn->prepare("SELECT a.id, a.crt_time, a.contnet, a.crt_user, CASE WHEN b.username IS NULL THEN CONCAT(a.crt_user, ' ( 遊客 ) ') ELSE b.nickname END AS nickname FROM marin_comments a LEFT JOIN marin_users b ON a.crt_user = b.username WHERE parent_id IS NULL ORDER BY crt_time DESC");
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		$pages = ceil($result->num_rows / 10);
		$index = 0;
		while($row = $result->fetch_assoc()) {
			$index++;
			$page = ceil($index / 10);
	?>
	<div class="main__post <?php echo 'main__post--page'.$page; ?>">
		<?php
			require('get_comments.php');
		?>
		<div class="main__post__subfrom">
			<form action="add_comments.php" method="POST">
				<div class="main__post__subfrom--nickname">
					<?php echo $userAccount === "" ? "請先登入" : $nickname; ?>
				</div>
				<div class="main__post__subfrom--textarea">
					<textarea name="contnet" placeholder="留言內容"></textarea>
				</div>
				<div>
					<?php 
						if($userAccount === "") {
					?>
							<button type="submit" disabled="true">請先登入</button>
					<?php
						} else {
					?>
							<button type="submit">留言</button>
					<?php
						}
					?>
				</div>
				<input type="hidden" name="parentId" value="<?php echo $row['id']; ?>">
			</form>
		</div>
	</div>
	<?php
		}
		$conn->close();
	?>
	<input type="hidden" id="pages" value="<?php echo $pages; ?>">
	<div class="main__page">
	</div>
</div>
<script src="myJS.js"></script>