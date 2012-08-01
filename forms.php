<?php
function display_login_form() {
	?>
<div id="phpAuthenticate">
<form action="index.php" id="signIn" method="post">
	<div class="formItem">
		<label id="lblEmail">Email Address</label> <input type="text"
			id="inputEmail" Name="inputEmail" />
	</div>
	<div class="formItem">
		<label id="lblPass">Password</label> <input type="password"
			id="inputPass" Name="inputPass" />
	</div>
	<div class="formItem">
		<input type="submit" id="inputSignIn" Name="inputSignIn"
			value="Sign in" />
	</div>
</form>
</div>
<div id="or">OR</div>
<div id="fbAuthenticate">
	<div id="auth-loggedout">
		<div class="fb-login-button" scope="Email">Login with Facebook</div>
	</div>
	<div id="auth-loggedin" style="display: none">
		Hi, <span id="auth-displayEmail"></span> (&nbsp;<a href="#"
			id="auth-logoutlink">Logout</a>&nbsp;)
	</div>
</div>
<?php } ?>