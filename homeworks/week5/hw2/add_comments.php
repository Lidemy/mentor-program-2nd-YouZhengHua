<?php
	require_once('conn.php');
	$nickname = "";
	if(isset($_COOKIE['userAccount'])){
		$nickname = $_COOKIE['userAccount'];
	}
	if(isset($_POST['nickname'])){
		$nickname = $_POST['nickname'];
	}
	$contnet = $_POST['contnet'];
	$sql = "";
	if(isset($_POST['parentId'])){
		$parentId = $_POST['parentId'];
		$sql = "INSERT INTO marin_comments (crt_user, contnet, parent_id) VALUES ('$nickname', '$contnet', '$parentId')";
	}
	else{
		$sql = "INSERT INTO marin_comments (crt_user, contnet) VALUES ('$nickname', '$contnet')";
	}
	$conn->query($sql);
	$conn->close();

	$url = "index.php";
	if(!isset($_COOKIE["userAccount"])) {
		$url = "index_guest.php";
	}

	header('Location: '.$url);
?>