<?php 
	require_once("model.php");
	$db_handle = new DBController();

	$sql_query ="SELECT * FROM products WHERE productname = '" . $_POST["productName"] . "'";
	$result = $db_handle->runQuery($sql_query);

	$productInfo = array();

	if(!empty($result)) {
		array_push($productInfo,$result[0]['Price'],$result[0]['Description'],$result[0]['Image']);
		echo json_encode($productInfo);
	}
	else {
		echo json_encode($productInfo);
	}
?>