	<form class ="box" method="POST" action ="?page=login_processing" onsubmit="return checkLogin()">
		<h1>Login form</h1>
		<input type="text" id="user" placeholder="Username" name="username" required="required" /><br><br>
		<input type="password" id="pass" placeholder= "Password" name="password" required="required"/><br><br>
		<input type="submit" id="sub" value="Login"/>
	</form>