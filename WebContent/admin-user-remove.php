<?php
	include_once 'dbconn.php';
	
	$uid = $_POST["id"];
	
	$query = "DELETE FROM members WHERE id = ".$uid;
	
	$qrslt = $dbobject->query($query);
	
	if($qrslt == FALSE) {
		echo "처리되지 않았습니다 code:q";
	}
	else {
		$dquery = "DELETE FROM record WHERE userid = ".$uid;
		$drslt = $dbobject->query($dquery);
		
		if($drslt == FALSE) {
			echo "처리되지 않았습니다 code:d1";
		}
		else {
			$dquery2 = "DELETE FROM notice WHERE userid = ".$uid;
			$d2rslt = $dbobject->query($dquery2);
			if($d2rslt == FALSE) {
				echo "처리되지 않았습니다 code:d2";
			}
			else {
				echo "ok";
			}
		}
	}
?>