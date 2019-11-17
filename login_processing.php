<?php
	$db_handle = new DBController();
	$cookie = new Cookies();
	$username = $_POST['username'];
	$password = $_POST['password'];

	if($username == "" || $password == "") {
		header ('location:index.php');
	}
	else{
		$sql_query = "SELECT * from user_info where name = '$username' and password = '$password'";
		$result = $db_handle->runQuery($sql_query);
		$num_rows = $db_handle->numRows($sql_query);
		if ($num_rows==0) {
			$_SESSION['err'] = "Login failed";
			header ('location:index.php');
		}else{
			$_SESSION['displayname'] = $result[0]["fullname"];
			setcookie("username",$username,time() + $cookie->get_expired_time(),"/");
			$displayname = $_SESSION['displayname'];
			$time = time() + $cookie->get_expired_time();
			$sql_insert = "INSERT INTO session_table(session_key, session_value, cookies_time) VALUES ( '$username', '$displayname', '$time')";
			if ($db_handle->runInsertQuery($sql_insert)) {
			    echo "New record created successfully";
			} else {
			    echo "Error: " . $sql_insert . "<br>";
			}
			$_SESSION['msg'] = "Login successfully";
			header ('location:index.php');
		}
	}
?>
