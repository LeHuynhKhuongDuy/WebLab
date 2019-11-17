<?php
	$db_handle = new DBController();
	$defaultRole = 3;
	$msg = "";
	$err = "";

	$username = $_POST['username'];
	$fullname = $_POST['fullname'];
	$password = $_POST['password'];

	if($username == "" || $password == ""){
		header("location:index.php");
	}
	else{
		$sql_query = "SELECT * from user_info where name = '$username'";
		$result = $db_handle->runQuery($sql_query);
		$num_rows = $db_handle->numRows($sql_query);

		if($num_rows != 0){
			$err .= "User has already existed "; 
		}
		else{
			$sql_insert = "INSERT INTO user_info(Name, Password, fullname, role) VALUES ( '$username', '$password', '$fullname','$defaultRole')";
	    	if($db_handle->runInsertQuery($sql_insert)){
	    		$msg .= "Register successfully ";
	    	}
	    	else {
	    		$err .= "Error registering ";
	    	}
		}
	}

	$_SESSION['msg'] = $msg;
	$_SESSION['err'] = $err;
  	header('location:index.php');
?>