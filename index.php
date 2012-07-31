<?php session_start(); ?>
<!DOCTYPE html>

<html>
<head>
<title>Facebook Functionality</title>
<link rel="stylesheet" href="main.css" type="text/css" />
<script src="http://code.jquery.com/jquery-latest.js"></script>
	<?php 
		include('functions.php');
		db_connect();
		load_db();
	 ?>
</head>
<body>
	<?php include_once('fb_init.php'); ?>
	<div id="wrapper">
		<h1>Facebook Integration Tests</h1>
		<p>Device sequential services servicing services deviation reflective
			n-tier, integer ethernet capacitance converter. Connectivity solution
			audio connectivity transponder, element, n-tier ethernet feedback
			device, video logistically. Coordinated inversion hyperlinked
			connectivity, transponder device sequential fragmentation, interface.
		</p>
		<p>Port plasma anomaly partitioned array capacitance encapsulated
			pulse kilohertz bypass logistically. Interface data developer
			developer remote scalar device distributed coordinated. Partitioned
			reflective, bridgeware, cache potentiometer computer plasma converter
			developer application.</p>


		<?php include_once('forms.php'); ?>
		<?php
			if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
				//var_dump($_SESSION);
				if (($_POST ['inputName']) && ($_POST ['inputEmail'])) {
					// var_dump($_POST['inputName'],($_POST['inputEmail']));
					$loginName = htmlentities( $_POST ['inputName'] );
					$loginEmail = htmlentities( $_POST ['inputEmail'] );
					$_SESSION ['loginName'] = $loginName;
					echo "Hello, ", $loginName, " / ", $loginEmail, " (&nbsp;<a href='", $_SERVER ['PHP_SELF'], "' onclick='<?php user_logout(); ?>'>Logout</a>&nbsp;)<br />";
					
					$sql = "SELECT login_name FROM logins";
					$result = mysql_query($sql);
					print("<p><strong>Database entries:</strong><br />");
					while($row = mysql_fetch_array($result)) {
						printf("%s <br />", $row['login_name']);
					}
					print("</p>");
					mysql_free_result($result);
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