<?php session_start(); ?>
<!DOCTYPE html>

<html>
<head>
<title>Facebook Functionality</title>
<link rel="stylesheet" href="main.css" type="text/css" />
<script src="http://code.jquery.com/jquery-latest.js"></script>
	<?php 
		include('functions.php');
	 ?>
</head>
<body>
	<?php include_once('fb_init.php'); ?>
	<div id="wrapper">
		<h1>Register for School Choice</h1>

		<?php include_once('forms.php'); ?>
		<?php
			if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
				//var_dump($_SESSION);
				if (($_POST ['inputEmail']) && ($_POST ['inputPass'])) {
					db_connect();
					load_db();
					$loginEmail = htmlentities( $_POST ['inputEmail'] );
					$loginPass = md5( $_POST ['inputPass'] );
					$_SESSION ['loginEmail'] = $loginEmail;
					
					$result = mysql_query ( "SELECT * from logins where loginEmail = '$loginEmail'" );
					//var_dump($result);
						$row = mysql_fetch_assoc($result);
						//var_dump($row ['loginEmail'], $loginEmail);
						if ($row ['loginEmail'] == $loginEmail) {
							// if returned email and password are already in db, echo "logged in as"
							//var_dump($row['loginPass'], $loginPass);
							if ($row ['loginPass'] == $loginPass) {
								echo "Signed in as ", $loginEmail, " (&nbsp;<a href='", $_SERVER ['PHP_SELF'], "' onclick='user_logout();'>Logout</a>&nbsp;)<br />";
							} else {
								// if email is already in db and password is wrong:
								display_login_form ();
								die ( '<p>This email address is already registered. Please log in with your existing password.</p>' );
							}
						} else {
							// if email address is new
							$loginQuery = mysql_query("INSERT INTO logins(loginEmail,loginPass) VALUES('$loginEmail','$loginPass')");
							echo "Welcome, ", $loginEmail, " (&nbsp;<a href='", $_SERVER ['PHP_SELF'], "' onclick='user_logout();'>Logout</a>&nbsp;)<br />";
						}
					
					
					mysql_close();
					
				} else {
					echo "<strong>Both fields are required.</strong><br />";
					display_login_form ();
				}
			} else {
				display_login_form ();
			} 
		?>

		
		
	</div><!-- wrapper -->
</body>
</html>