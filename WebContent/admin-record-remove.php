<?php
	include_once 'dbconn.php';
	
	$rid = $_POST["id"];
	$mid = $_POST["mid"];
	$uid = $_POST["uid"];
	$dquery = "DELETE FROM record WHERE id = ".$rid;
	$drslt = $dbobject->query($dquery);
	if($drslt == FALSE) {
		echo "처리되지 않았습니다 code:d";
	}
	else {
		$uquery = "UPDATE total SET r".$mid." = 0 WHERE userid = ".$uid;
		$urslt = $dbobject->query($uquery);
		if($urslt == FALSE) {
			echo "처리되지 않았습니다 code:u";
		}
		else {
			echo "ok";
		}
	}
?>