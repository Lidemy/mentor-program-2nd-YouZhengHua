<?php
	require_once('conn.php');
	$tmpId = $_COOKIE["tmpId"];
	$postId = $_POST['commentId'];
	$rtnCde = "success";

	$stmt = $conn->prepare("SELECT c.id FROM marin_users_certificate a JOIN marin_users b ON a.username = b.username JOIN marin_comments c ON c.crt_user = b.username AND c.id = ?  WHERE a.id = ?");
	$stmt->bind_param("is", $postId, $tmpId);

	if($stmt->execute()){
		$certificate = $stmt->get_result();
		$stmt->close();

		$certificateRow = $certificate->fetch_assoc();
		$commentId = $certificateRow['id'];
		$stmt = $conn->prepare("DELETE FROM marin_comments WHERE id = ? OR parent_id = ?");
		$stmt->bind_param("ii", $commentId, $commentId);
		if(!$stmt->execute()){
			$rtnCde = "fail";
		}
		$stmt->close();
	}
	else{
		$stmt->close();
		$rtnCde = "fail";
	}
	$conn->close();

	$result["rtnCde"] = $rtnCde;
	echo json_encode($result);
?>