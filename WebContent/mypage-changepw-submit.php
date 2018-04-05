<?php
	include_once 'dbconn.php';
	
	$id = $_POST["id"];
	$sc = $_POST["sc"];
	
	$loginq = "UPDATE members SET sc=PASSWORD('".$sc."') WHERE textid='".$id."'";
	$loginr = $dbobject->query($loginq);
	if($loginr == FALSE) {
		echo "코드 변경을 실패했습니다. ".$loginq;
	}
	else {
		echo "ok";
	}
?>