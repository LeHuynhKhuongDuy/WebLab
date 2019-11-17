<?php
	require_once("model.php");
	$db_handle = new DBController();
	$username = $_POST['nameInput'];

	$sql_query = "SELECT * from user_info where name = '$username'";
	$num_rows = $db_handle->numRows($sql_query);

	if ($num_rows != 0) {
		echo "User has already existed";
	}
?>