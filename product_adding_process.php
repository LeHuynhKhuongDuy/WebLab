<?php
	define ("MAX_SIZE_KB","150");
	$db_handle = new DBController();
	$extensions_arr = array("jpg","jpeg","png","gif");
	$name = $_FILES['image']['name'];
	$target_dir = "wwwroot/images/";
	$UploadOK = 1;
	$err = "";
	$msg = "";

	$productName = $_POST['productName'];
	$price = $_POST['price'];
	$description = $_POST['description'];

	$target_file = $target_dir . basename($name);

	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	$size = $_FILES["image"]["size"];

	$sql_query = "SELECT * from products where ProductName = '$productName'";
	$result = $db_handle->runQuery($sql_query);
	$num_rows = $db_handle->numRows($sql_query);

	if ($size > MAX_SIZE_KB*1024){
		$UploadOK = 0;
		$err .= "File size is too large "; 
	}
	else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $name != ""){
		$UploadOK = 0;
		$err .= "This is not a image ";
  	}

  	if($UploadOK == 1 && $name != ""){
		$target_file_name = $target_dir . $productName . "." . $imageFileType;
	}
	else{
		$target_file_name = '';
	}

	if($num_rows != 0){
		if($result[0]["Image"] != ''){
			if(unlink($result[0]["Image"])){
				$msg .= "Delete image successfully ";
			}
			else{
				$err .= "Error deleting ";
			}
		}

		$sql_update = "UPDATE products SET Price = '$price', Description = '$description', Image = '$target_file_name'  WHERE ProductName = '$productName'";
		if($db_handle->runInsertQuery($sql_update)){
			$msg .= "Update successfully ";
		}
		else{
			$err .= "Error updating ";
		}
	    
	    if($UploadOK == 1 && $name != ""){
	    	if(move_uploaded_file($_FILES['image']['tmp_name'],$target_file_name)){
	    		$msg .= "Image updated";
	    	}
	    	else {
	    		$err .= "Error image updating ";
	    	}
		}
	}
	else{
  		$sql_insert = "INSERT INTO products(ProductName, Price, Description, Image) VALUES ( '$productName', '$price', '$description','$target_file_name')";
	    if($db_handle->runInsertQuery($sql_insert)){
	    	$msg .= "Create successfully ";
	    }
	    else {
	    	$err .= "Error creating ";
	    }
	    
	    if($UploadOK == 1){
	    	if(move_uploaded_file($_FILES['image']['tmp_name'],$target_file_name)){
	    		$msg .= "Image added ";
	    	}
	    	else {
	    		$err .= "Error image adding ";
	    	}
		}
  	}

	$_SESSION['msg'] = $msg;
	$_SESSION['err'] = $err;

  	header('location:index.php');
?>