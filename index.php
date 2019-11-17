<?php
	session_start();
	require_once("model.php");
	$db_handle = new DBController();
	$cookie = new Cookies();

	if(empty($_COOKIE['username'])){
		$_SESSION['enableDisplay'] = 0;
		$_SESSION['user_role'] = 4;
	}
	else{
		$username = $_COOKIE['username'];
		$time = time();

		$sql_query = "SELECT * from session_table where session_key = '$username' and cookies_time >= '$time'";
		$result = $db_handle->runQuery($sql_query);
		$num_rows = $db_handle->numRows($sql_query);

		if($num_rows != 0){
			$_SESSION['enableDisplay'] = 1;
			$newExpiredTime = time() + $cookie->get_expired_time();
			$_SESSION['displayname'] = $result[0]["session_value"];
			$displayname = $_SESSION['displayname'];

			setcookie("username",$username,time() + $cookie->get_expired_time(),"/");
			$sql_insert = "INSERT INTO session_table(session_key, session_value, cookies_time) VALUES ( '$username', '$displayname', '$newExpiredTime')";
			$db_handle->runInsertQuery($sql_insert);
		}

		$sql_query2 = "SELECT * from user_info where name = '$username'";
		$result2 = $db_handle->runQuery($sql_query2);

		$_SESSION['user_role'] = $result2[0]["role"] == null ? 4 : $result2[0]["role"]; 
	}
	
	if(isset($_GET['page']) || isset($_POST['page'])){
		if(isset($_GET['page'])){
			$page = $_GET['page'];
			include "header.php";
			include "$page.php";
			include "footer.php";
		}
		else if(isset($_POST['page'])){
			$page = $_POST['page'];
			include "header.php";
			include "$page.php";
			include "footer.php";
		}
	}
	else {
		include "header.php";
		include "homepage.php";
		include "footer.php";
	}
?>