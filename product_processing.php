<div>
<?php
	$db_handle = new DBController();
	$product_name = $_POST['product_name'];
	if($product_name == "") {
		header ('location:index.php');
	}
	else{
		$sql_query = "SELECT * from products where ProductName like '%" . $product_name . "%'";
		$result = $db_handle->runQuery($sql_query);
		$num_rows = $db_handle->numRows($sql_query);
		if ($num_rows==0) {
			echo "<div><h2>Your product is not found</h2></div>";
			echo "<img src=\"wwwroot/images/sorry.jpg\" height=\"290px\" width=\"300px\"/>";
			echo "<div><h3>Please click <strong>Home</strong> to return to home page</div>";
		}else{
			$count = 1;
			foreach ( $result as $product ) {
				echo "<div>";
				echo "Product " . $count . "<br>";
				echo "Product name: " . $product["ProductName"] . "<br>";
				echo "Price: " . $product["Price"] . "<br>";
				echo "Description: " . nl2br($product["Description"]) . "<br>";
				if($product["Image"] == null){
					echo "<img src=\"" . "wwwroot/images/sorry.jpg" . "\" alt=\"Laptop is not found\" height=\"30%\" width=\"30%\"/>";
					echo "<h4>Laptop image is not found</h4>";
					echo "<h4>We are trying to fix this problem.</h4>";
				}
				else{
					echo "<img src=\"" . $product["Image"] . "\" alt=\"Laptop\" height=\"50%\" width=\"50%\"/>";
				}
				echo "</div>";
				$count++;
			}
		}
	}
?>
</div>