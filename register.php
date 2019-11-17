	<div class="main-w3layouts wrapper">
		<h1>SignUp Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="?page=register_processing" method="post" onsubmit="return checkRegister()">
					<input id="user_signup" class="text_regis" type="text" name="username" placeholder="Username" required="required"> <div id="signUpValidate" class="text-danger"></div>
					<input class="text_regis" type="text" name="fullname" placeholder="Fullname" required="required">
					<input id="pass_signup" class="text_regis" type="password" name="password" placeholder="Password" required="required">
					<input id="pass_signup_comfirm" class="text_regis" type="password" name="password" placeholder="Confirm Password" required="required">
					<input id="btn_regis_submit" type="submit" value="SIGNUP">
				</form>
			</div>
		</div>
	</div>