<?php
	setcookie("userAccount", "",time()+3600*24);
	setcookie("nickname", "", time()+3600*24);
	header('Location: index.php');
?>