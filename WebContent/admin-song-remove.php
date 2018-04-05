<?php
include_once 'dbconn.php';
	
	$mid = $_POST["mid"];
	
	// column add
	$cquery = "ALTER TABLE total DROP COLUMN r".$mid;
	$crslt = $dbobject->query($cquery);
	if($crslt == FALSE) {
		echo "Alter Query Error";
	}
	else {
		// modify music
		$mquery = "UPDATE music SET inuse = 'N' where id = ".$mid;
		$mrslt = $dbobject->query($mquery);
		if($mrslt == FALSE) {
			echo "Update Query Error";
		}
		else {
			$dquery = "DELETE FROM record WHERE musicid = ".$mid;
			$drslt = $dbobject->query($dquery);
			if($drslt == FALSE) {
				echo "Delete Query Error";	
			}
			else {
				echo "ok";
			}
		}
	}
?>