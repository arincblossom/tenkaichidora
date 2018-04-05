<?php
	include_once 'dbconn.php';
	
	$mid = $_POST["mid"];
	$ptid = $_POST["ptid"];
	$pt;
	
	if($ptid == 9) {
		$pt = "dbsc";
	}
	else if($ptid == 10) {
		$pt = "dadv";
	}
	else if($ptid == 11) {
		$pt = "dext";
	}
	else if($ptid == 12) {
		$pt = "dmas";
	}
	
	// column add
	$cquery = "ALTER TABLE total ADD COLUMN r".$mid." DOUBLE UNSIGNED ZEROFILL NOT NULL DEFAULT 0";
	$crslt = $dbobject->query($cquery);
	if($crslt == FALSE) {
		echo "Alter Query Error";
	}
	else {
		// modify music
		$mquery = "UPDATE music SET inuse = '".$pt."' where id = ".$mid;
		$mrslt = $dbobject->query($mquery);
		if($mrslt == FALSE) {
			echo "Update Query Error";
		}
		else {
			echo "ok";
		}
	}
?>