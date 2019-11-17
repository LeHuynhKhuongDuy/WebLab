$(document).ready(function(){
	// scrool up btn
	var btn = $('#buttonScrollUp');
	
    $(window).scroll(function() {
	  if ($(window).scrollTop() > 50) {
	    btn.addClass('show');
	  } else {
	    btn.removeClass('show');
	  }
	});

	btn.on('click', function(e) {
	  e.preventDefault();
	  $('html, body').animate({scrollTop:0}, '300');
	});

	/*
	$(window).click(function () {
		setCookie(username,<?php $_SESSION['displayname']?>,10);
	});

	$(window).mousemove(function () {

	});
	*/
	// Home click
	$('#Home').on('click', function(){
		window.location.href = "?page=homepage";
	});

	// Contact click
	$('#Contact').on('click', function(){
		window.location.href = "?page=contact";
	});

	// Phone dropdown event
	$("#Phones").mouseenter(function(){
		$(".dropdown-content2").css("display","block");
	}).mouseleave(function(){
		if(!$(".dropdown-content2").is(":hover")){
			$(".dropdown-content2").css("display","none");
		}
	});

	$(".dropdown-content2").mouseleave(function(){
		$(".dropdown-content2").css("display","none");
	});

    // search-box autocomplete 
	$("#search-box").keyup(function(){
		if($('#search-box').val() == ""){
			$('#suggesstion-box').hide();
		}
		else{
			$.ajax({
			type: "POST",
			url: "searchForm.php",
			data:'keyword='+$(this).val(),
			success: function(data){
				$("#suggesstion-box").show();
				$("#suggesstion-box").html(data);
				$("#search-box").css("background","#FFF");
			}
			});
		}
	});

	// click outside of suggestion box
	$(document).mouseup(e => {
	   	if (!$("#suggesstion-box").is(e.target))
	   	{
	     	$("#suggesstion-box").hide();
	  	}
	});

	// error msg
	$(function(){
	    $("#err_msg").fadeOut(5000);
	});
	
	// inform msg
	$(function(){
		$("#info_msg").fadeOut(5000);
	});

	// signup validate username
	$('#user_signup').focusout(function(){
		$.ajax({
			type: "POST",
			url: "validateName.php",
			data: "nameInput="+$(this).val(),
			success: function(data){
				$('#signUpValidate').html(data);
			}
		});
	});
});

function selectProduct(val) {
	$("#search-box").val(val);
	$("#submit-product").trigger("click");
	$("#suggesstion-box").hide();
}

function showHint(str) {
	if (str.length == 0) {
	    document.getElementById("nameHint").innerHTML = "Insert pls";
	    return;
	} else {
	  	var xhttp = new XMLHttpRequest();
	  	xhttp.onreadystatechange = function() {
	    	if (this.readyState == 4 && this.status == 200) {
	     		document.getElementById("nameHint").innerHTML = this.responseText;
	    	}
	  	};
	  	xhttp.open("GET", "ajax_name.php?q=" + str, true);
	  	xhttp.send();
  	}
}

function setCookie(cname, cvalue, exsecond) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays*1000));
	var expires = "expires="+ d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function checkLogin(){
	var user = document.getElementById('user').value;
	var pass = document.getElementById('pass').value;
	if(pass.length > 8){
		alert("Password is too long");
		return false;
	}
	else{
		return true;
	}
}

function checkRegister(){
	var userSignup = $('#user_signup').val();
	var passSignup = $('#pass_signup').val();
	var passSignupConfirm = $('#pass_signup_comfirm').val();

	if(userSignup.length > 50){
		alert("Username is too long");
		return false;
	}

	if(passSignup.length > 8){
		alert("Password is too long");
		return false;
	}

	if(passSignup != passSignupConfirm){
		alert("Your password comfirmation is not match");
		return false;
	}

	return true;
}

function search_Product(){
	var productName = $('#product_add_name').val();
	if(productName == ""){
		$('#product_add_price').val("");
		$('#product_add_des').val("");
		$('#product_add_img').html("");
		return;
	}
	else{
		$.ajax({
			type: "POST",
			url: "searchProductAdd.php",
			data:'productName='+productName,
			success: function(data){
				$('#product_add_price').val(data[0]);
				$('#product_add_des').val(data[1]);
				if(data.length != 0){
					if(data[2] != ""){
						$('#product_add_img').html("Image is avaliable");
					}
				}
				else{
					$('#product_add_img').html("");
				}
			},
			dataType:"json"
		});
	}
}