<?php
	header("Content-Type: text/html; charset=UTF-8");
	session_start();
	
	/*$host = "localhost:3306";
	$user = "root";
	$pw = "root";
	$db = "trik";*/
	
	$host = "";
	$user = "";
	$pw = "";
	$db = "trik";
	
	$dbobject = new mysqli($host, $user, $pw, $db);
	$dbobject->set_charset("utf8");
	/* check connection */
	if ($dbobject->connect_errno) {
		printf("Connect failed: %s\n", $dbobject->connect_error);
		exit();
	}
	
	// TRIK competition page by Arin (roxyeris@gmail.com) / (c) 2016.05
?>