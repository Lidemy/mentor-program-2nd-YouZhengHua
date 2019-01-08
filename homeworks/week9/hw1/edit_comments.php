<?php
	require_once('conn.php');
	
	if(isset($_SESSION["userAccount"])){
		$postId = $_POST['commentId'];
		$stmt = $conn->prepare("SELECT c.id FROM marin_comments c WHERE c.crt_user = ? AND c.id = ?");
			$stmt->bind_param("si", $_SESSION["userAccount"], $postId);
		if($stmt->execute()){
			$certificate = $stmt->get_result();
			$stmt->close();

			$certificateRow = $certificate->fetch_assoc();
			$commentId = $certificateRow['id'];
			$contnet = $_POST['contnet'];
			$stmt = $conn->prepare("UPDATE marin_comments SET contnet = ? WHERE id = ?");
			$stmt->bind_param("si", $contnet, $commentId);
			$stmt->execute();
			$stmt->close();
		}
		else{
			$stmt->close();
		}
	}
	$conn->close();

	$url = "index.php";

	header('Location: '.$url);
?>