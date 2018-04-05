<?php
	include_once "dbconn.php";
	
	$noticeid = $_POST["id"];
	$nquery = "DELETE FROM notice WHERE id=".$noticeid;
	$nrslt = $dbobject->query($nquery);
	if($nrslt == FALSE) {
		echo $nquery."알림 삭제에 실패하였습니다";
	}
	else {
		echo "ok";
	}
?>