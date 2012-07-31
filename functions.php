<?php

function db_connect() {
	$link = mysql_connect('127.0.0.1','root','');
	if(!$link) {
		die('Connection to database failed: ' . mysql_error());
		return;
	}
	return $link;
}

function load_db() {
	$db = mysql_select_db('fblogin');
	if(!$db) {
		die('This site\'s database is not available: ' . mysql_error());
	}
}


function user_logout() {
	unset($_SESSION);
}


?>