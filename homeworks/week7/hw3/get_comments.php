<?php
	$showPage = 1;
	if(isset($_GET['page'])){
		$showPage = ceil($_GET['page']);
	}
	$startCounts = $showPage <= 1 ? 0 : ($showPage - 1)*10;
	$stmt = $conn->prepare("SELECT a.id, a.crt_time, a.contnet, a.crt_user, CASE WHEN ( b.username IS NULL OR b.username = '' ) THEN a.crt_user ELSE b.nickname END AS nickname FROM marin_comments a LEFT JOIN marin_users b ON a.crt_user = b.username WHERE parent_id IS NULL ORDER BY crt_time DESC LIMIT ?, 10");
	$stmt->bind_param("i", $startCounts);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	while($row = $result->fetch_assoc()) {
?>
	<div class="row">
		<div class="main__post col div-border">
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
					<div class="postAction__edit wt-90">
						<form action="edit_comments.php" method="POST">
							<div class="margin-bot-10">
								<textarea class="postAction__textarea wt-100" name="contnet" placeholder="留言內容" style="display: none;"><?php echo $row['contnet']; ?></textarea>
							</div>
							<input type="hidden" name="commentId" value="<?php echo $row['id']; ?>">
							<button type="submit" class="btn postAction__edit--submit" style="display: none;">送出</button>
							<button type="button" class="btn postAction__edit--cancel" style="display: none;">取消</button>
							<button type="button" class="btn postAction__edit--show" value="edit">編輯</button>
						</form>
					</div>
					<div class="postAction__del">
						<input type="hidden" name="commentId" value="<?php echo $row['id']; ?>">
						<button class="btn postAction__del--submit" value="del">刪除</button>
					</div>
				</div>
			<?php
			}
				$parentId = $row['id'];
				$stmt = $conn->prepare("SELECT a.id, a.crt_time, a.contnet, a.crt_user, CASE WHEN ( b.username IS NULL OR b.username = '' ) THEN a.crt_user ELSE b.nickname END AS nickname , b.username FROM marin_comments a LEFT JOIN marin_users b ON a.crt_user = b.username WHERE a.parent_id = ?");
				$stmt->bind_param("i", $parentId);
				$stmt->execute();
				$subResult = $stmt->get_result();
				$stmt->close();
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
							<div class="postAction__edit wt-100">
								<form action="edit_comments.php" method="POST">
									<div class="margin-bot-10">
										<textarea class="postAction__textarea wt-90" name="contnet" placeholder="留言內容" style="display: none;"><?php echo $subRow['contnet']; ?></textarea>
									</div>
									<input type="hidden" name="commentId" value="<?php echo $subRow['id']; ?>">
									<button type="submit" class="btn postAction__edit--submit" style="display: none;">送出</button>
									<button type="button" class="btn postAction__edit--cancel" style="display: none;">取消</button>
									<button type="button" class="btn postAction__edit--show" value="edit">編輯</button>
								</form>
							</div>
							<div class="postAction__del postAction__del--sub">
								<input type="hidden" name="commentId" value="<?php echo $subRow['id']; ?>">
								<button class="btn postAction__del--submit" value="del">刪除</button>
							</div>
						</div>
					<?php } ?>
				</div>
			<?php
				}
			?>
			<div class="main__post__subfrom" style="display: none;">
				<div class="main__post__subfrom--nickname">
					<?php echo $userAccount === "" ? "請先登入" : $nickname; ?>
				</div>
				<div>
					<textarea class="main__post__subfrom--textarea wt-90 margin-bot-10" name="contnet" placeholder="留言內容"></textarea>
				</div>
				<div>
					<?php 
						if($userAccount === "") {
					?>
							<input class="btn btn-primary btn-lg" type="button" disabled="true" value="請先登入" />
					<?php
						} else {
					?>
							<input class="btn btn-primary btn-lg" type="button" value="送出">
					<?php
						}
					?>
				</div>
				<input type="hidden" name="parentId" value="<?php echo $row['id']; ?>">
			</div>
			<div class="margin-top-10">
				<input class="btn btn-primary subfromFrom--show" type="button" value="我要留言">
			</div>
		</div>
	</div>
<?php
	}
?>