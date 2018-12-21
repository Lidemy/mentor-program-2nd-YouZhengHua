<?php
	require_once('conn.php');
	$tmpId = $_COOKIE["tmpId"];
	$stmt = $conn->prepare("SELECT b.* FROM marin_users_certificate a JOIN marin_users b ON a.username = b.username WHERE a.id = ?");
	$stmt->bind_param("s", $tmpId);
	$stmt->execute();
	$certificate = $stmt->get_result();
	$stmt->close();
	if($certificate->num_rows === 1){
		$certificateRow = $certificate->fetch_assoc();
		$commentId = $_POST['commentId'];
		$stmt = $conn->prepare("DELETE FROM marin_comments WHERE (id = ? AND crt_user = ?) OR parent_id = ?");
		$stmt->bind_param("isi", $commentId, $certificateRow['username'], $commentId);
		$stmt->execute();
		$stmt->close();
	}
	$conn->close();
	$url = "index.php";

	header('Location: '.$url);
?>