<?php
	if(empty($_COOKIE['username'])){
		header("location:index.php");	
	}
?>
<h4>Add new product infomation below<span class="text-danger">(Image may not required)</span></h4>
<div>
	If you want to add new product, just input all these information and press <span class="bg-success">ADD</span><br>
	If you want to update a product, just do the same as adding. Also you can input the product name and press <span class="bg-success">Search</span>
	below to quickly fill all avaliable information.
</div>
<button class="btn btn-success" onclick="search_Product()">Search</button>

<form class="product_adding" method="POST" action="?page=product_adding_process" enctype='multipart/form-data'> 
	<table>
		<tr>
			<th>Product name </th>
			<th><textarea id="product_add_name" rows="1" cols="50" name="productName" required="required"></textarea></th> 
		</tr>
		<tr>
			<th>Price(USD) </th>
			<th><input id="product_add_price" type="number" name="price" required="required" /></th>
		</tr>
		<tr>
			<th>Description </th>
			<th><textarea id="product_add_des" rows="4" cols="50" name="description" required="required"></textarea></th>
		</tr>
		<tr>
			<th>Image </th>
			<th><input type="file" name="image"/></th>
			<th><div id="product_add_img"></div></th>
		</tr>
	</table>
	<input type="submit" value="ADD" />
</form>