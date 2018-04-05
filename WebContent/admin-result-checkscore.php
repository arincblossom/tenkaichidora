<?php
	include_once "dbconn.php";
	
	$resultid = $_POST["id"];
	$level = $_POST["level"];
	
	// 1. get result with result id
	$squery = "SELECT * FROM record WHERE id = ".$resultid;
	$srslt = $dbobject->query($squery);
	if($srslt == FALSE) {
		echo $squery." / S-Query Failed";
	}
	else {
		$srow = $srslt->fetch_assoc();
		$mid = $srow["musicid"];
		$uid = $srow["userid"];
		
		// 2. if result with same song/user/pattern exist - remove
		$squery2 = "SELECT * FROM record ".
					"WHERE userid = ".$uid.
					" AND musicid = ".$mid.
					" AND authorized = 'Y'";
		$srslt2 = $dbobject->query($squery2);
		if($srslt2 != FALSE && $srslt2->num_rows > 0) {
			$srow2 = $srslt2->fetch_assoc();
			echo $srow2["appliedscore"];
		}
		else {
			echo "fail";
		}
	}
?>