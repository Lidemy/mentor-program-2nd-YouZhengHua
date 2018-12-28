<?php
	require_once('conn.php');
	
	$result = null;
	$rtnCde = "success";

	if(isset($_SESSION["userAccount"])){
		$postId = $_POST['commentId'];
		$stmt = $conn->prepare("SELECT c.id FROM marin_comments c WHERE c.crt_user = ? AND c.id = ?");
		$stmt->bind_param("si", $_SESSION["userAccount"], $postId);

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
	}
	$conn->close();

	$result["rtnCde"] = $rtnCde;
	echo json_encode($result);
?>