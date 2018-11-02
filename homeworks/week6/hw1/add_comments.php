<?php
	require_once('conn.php');
	$tmpId = "";
	if(isset($_COOKIE['tmpId'])){
		$tmpId = $_COOKIE['tmpId'];
	}
	$contnet = $_POST['contnet'];
	$sql = "";
	if(isset($_POST['parentId'])){
		$parentId = $_POST['parentId'];
		$sql = "INSERT INTO marin_comments (crt_user, contnet, parent_id) SELECT b.username AS crt_user, '$contnet' AS contnet, '$parentId' AS parent_id FROM marin_users_certificate a JOIN marin_users b ON a.username = b.username WHERE a.id = '$tmpId'";
	}
	else{
		$sql = "INSERT INTO marin_comments (crt_user, contnet) SELECT b.username AS crt_user, '$contnet' AS contnet FROM marin_users_certificate a JOIN marin_users b ON a.username = b.username WHERE a.id = '$tmpId'";
	}
	$conn->query($sql);
	$conn->close();

	$url = "index.php";

	header('Location: '.$url);
?>