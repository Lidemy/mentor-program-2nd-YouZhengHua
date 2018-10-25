<div class="main__info">
	<div class="main__info-name">
		<?php echo $row['crt_user']; ?>
	</div>
	<div class="main__info-time">
		<?php echo $row['crt_time']; ?>
	</div>
</div>
<div class="main__comment-text">
	<?php echo $row['contnet']; ?>
</div>
<?php
	$parentId = $row['id'];
	$sql = "SELECT a.crt_time, a.contnet, CASE WHEN b.username IS NULL THEN CONCAT(a.crt_user, ' ( 遊客 ) ') ELSE b.nickname END AS crt_user FROM marin_comments a LEFT JOIN marin_users b ON a.crt_user = b.username WHERE a.parent_id = $parentId";
	$subResult = $conn->query($sql);

	while($subRow = $subResult->fetch_assoc()) {
?>
	<div class="main__subComment">
		<div class="main__info">
			<div class="main__info-name"><?php echo $subRow['crt_user']; ?></div>
			<div class="main__info-time"><?php echo $subRow['crt_time']; ?></div>
		</div>
		<div class="main__subComment-text"><?php echo $subRow['contnet']; ?></div>
	</div>
<?php
	}
?>