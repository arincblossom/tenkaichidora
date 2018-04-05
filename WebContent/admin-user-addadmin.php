<?php
	include_once 'dbconn.php';
	
	$uid = $_POST["id"];
	
	$query = "UPDATE members SET isadmin='Y' WHERE id = ".$uid;
	
	$qrslt = $dbobject->query($query);
	
	if($qrslt == FALSE) {
		echo "처리되지 않았습니다";
	}
	else {
		echo "ok";
	}
?>