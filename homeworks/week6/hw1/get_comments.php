<div class="main__post__info">
	<div class="main__post__info--name">
		<?php echo htmlspecialchars($row['nickname']); ?>
	</div>
	<div class="main__post__info-time">
		<?php echo $row['crt_time']; ?>
	</div>
</div>
<div class="main__post__comment--text">
	<?php echo htmlspecialchars($row['contnet']); ?>
</div>
<?php if($row['crt_user'] === $userAccount){ ?>
	<div class="postAction">
		<div class="postAction__edit">
			<form action="edit_comments.php" method="POST">
				<div class="postAction__textarea" style="display: none;">
					<textarea name="contnet" placeholder="留言內容"><?php echo $row['contnet']; ?></textarea>
				</div>
				<input type="hidden" name="commentId" value="<?php echo $row['id']; ?>">
				<button type="submit" class="postAction__edit--submit" style="display: none;">送出</button>
				<button type="button" class="postAction__edit--onclick" value="edit">編輯</button>
			</form>
		</div>
		<div class="postAction__del">
			<form action="del_comments.php" method="POST">
				<input type="hidden" name="commentId" value="<?php echo $row['id']; ?>">
				<button type="submit">刪除</button>
			</form>
		</div>
	</div>
<?php
}
	$parentId = $row['id'];
	$sql = "SELECT a.id, a.crt_time, a.contnet, a.crt_user, CASE WHEN b.username IS NULL THEN CONCAT(a.crt_user, ' ( 遊客 ) ') ELSE b.nickname END AS nickname, b.username FROM marin_comments a LEFT JOIN marin_users b ON a.crt_user = b.username WHERE a.parent_id = $parentId";
	$subResult = $conn->query($sql);

	while($subRow = $subResult->fetch_assoc()) {
?>
	<div class="main__subpost <?php if($subRow['nickname'] === $row['nickname']){ echo " main__subpost--self";} ?>">
		<div class="main__subpost__info">
			<div class="main__subpost__info--name"><?php echo htmlspecialchars($subRow['nickname']); ?></div>
			<div class="main__subpost__info--time"><?php echo $subRow['crt_time']; ?></div>
		</div>
		<div class="main__subpost__comment--text"><?php echo htmlspecialchars($subRow['contnet']); ?></div>
		<?php if($subRow['crt_user'] === $userAccount){ ?>
			<div class="postAction">
				<div class="postAction__edit">
					<form action="edit_comments.php" method="POST">
						<div class="postAction__textarea postAction__textarea--sub" style="display: none;">
							<textarea name="contnet" placeholder="留言內容"><?php echo $subRow['contnet']; ?></textarea>
						</div>
						<input type="hidden" name="commentId" value="<?php echo $subRow['id']; ?>">
						<button type="submit" class="postAction__edit--submit" style="display: none;">送出</button>
						<button type="button" class="postAction__edit--onclick" value="edit">編輯</button>
					</form>
				</div>
				<div class="postAction__del">
					<form action="del_comments.php" method="POST">
						<input type="hidden" name="commentId" value="<?php echo $subRow['id']; ?>">
						<button type="submit">刪除</button>
					</form>
				</div>
			</div>
		<?php } ?>
	</div>
<?php
	}
?>