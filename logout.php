<?php
	session_destroy();
	setcookie("username",$_SESSION['displayname'],time() - 1,"/");
	header ('location:index.php');
?>