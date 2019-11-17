<!DOCTYPE html>
<html lang="en">
<head>
	<title>Awesome Home page</title>
	<link rel="stylesheet" type="text/css" href="wwwroot/css/site.css">
	<link rel="stylesheet" type="text/css" href="wwwroot/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="wwwroot/css/jquery-ui.css">
	<script type="text/javascript" src="wwwroot/js/jquery-3-4-1.min.js"></script>
	<script type="text/javascript" src="wwwroot/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="wwwroot/js/bootstrap.js"></script>
	<script type="text/javascript" src="wwwroot/js/home.js"></script>
</head>

<body>
	<h5 id="err_msg" class="caution text-danger">
		<?php 
			if(isset($_SESSION['err'])){
				echo $_SESSION['err']; 
				$_SESSION['err'] = "";
			}
		?>
	</h5>
	<h5 id="info_msg" class="message text-success">
		<?php 
			if(isset($_SESSION['msg'])){
				echo $_SESSION['msg']; 
				$_SESSION['msg'] = "";
			}
		?>	
	</h5>
	<div class="container_fluid">
	<img id="logo" src="wwwroot/images/BK.png"/>
	<?php 
		if($_SESSION['enableDisplay'] == 0){
			unset($_SESSION['displayname']);
			echo "<div id=\"login\"><a href=\"?page=login\">Login</a></div>";
			echo "<div id=\"reg\"><a href=\"?page=register\">Register</a></div>";
		}
		else if($_SESSION['enableDisplay'] == 1){
			echo "<div id=\"login\">" . $_SESSION['displayname'] . "</div>";
		}
	?>
	<form autocomplete="off" class="searchForm" method="POST" action ="?page=product_processing">
		<input type="text" id="search-box" name="product_name"/>
		<input type="submit" id="submit-product" class="btn btn-success" value="Search" />
		<div id="suggesstion-box"></div>
	</form>
	<?php
		if(!empty($_COOKIE['username'])){
			if($_SESSION['user_role'] <= 1){
				echo "<div class=\"addProduct\" align=\"center\"><a class=\"addProductHref\" href=\"?page=product_adding\">Add new product</a></div>";
			}
		}
	?>
	<div id="logout"><a href="?page=logout">Logout</a></div>
	<table id="nav_bar">
		<tr>
			<td id="Home">Home</td>
			<td id="Products">
			<div class="dropdown">
				<div class="dropbtn1">Products</div>
				<div class="dropdown-content1">
			    <a href="#">Laptop</a>
			    <a href="#">Desktop</a>
				<div id="Phones">Phones</div>
					<div class="dropdown-content2">
				  		<a href="#">Apple</a>
				  		<a href="#">Samsung</a>
				  		<a href="#">Others</a>
				  	</div>
				<a href="#">Others</a>
				</div>
			</div>
			</td>
			<td id="Contact">Contact us</td>
		</tr>
	</table>
	<a id="buttonScrollUp"></a>
		<div class="row main_content">
			<div class="col-sm-3 col-col-md-3 col-lg-3 right_border">
<pre class="basic_infomation_homepage">
	- Laptop
	- Desktop
		+ CPU
		+ Keyboard
		+ Mouse
		+ Others
	- Tablet
	- Phones
		+ Apple
		+ Samsung 
		+ Xiaomi
		+ Others
	- Battery
	- Earphone
	- Headphone
	- Ram
</pre>
			</div>
			<div class="col-sm-9 col-md-9 col-lg-9">
