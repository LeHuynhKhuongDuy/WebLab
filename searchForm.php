<?php 
	require_once("model.php");
	$db_handle = new DBController();

	$sql_query ="SELECT * FROM products WHERE productname like '%" . $_POST["keyword"] . "%' ";
	$result = $db_handle->runQuery($sql_query);

	if(!empty($result)) {
		echo "<ul id=\"product-list\">";
		foreach($result as $product) {
			echo "<li onClick=" . "\"selectProduct('". $product["ProductName"] . "');\">";
			echo $product["ProductName"];
			echo "</li>";
		}
		echo "</ul>";
	}
?>