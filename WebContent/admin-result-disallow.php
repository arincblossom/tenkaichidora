<?php
	include_once "dbconn.php";

	$resultid = $_POST["id"];
	
	$squery = "SELECT * FROM record WHERE id = ".$resultid;
	$srslt = $dbobject->query($squery);
	if($srslt == FALSE) {
		echo $squery."/Query Error";
	}
	else {
		$srow = $srslt->fetch_assoc();
		$mid = $srow["musicid"];
		$uid = $srow["userid"];
		
		$dquery = "DELETE FROM record ".
				"WHERE id = ".$resultid;
		$drslt = $dbobject->query($dquery);
		if($drslt != FALSE) {
			// update notice
			// 5. update notice
			$mquery = "SELECT * FROM music WHERE id=".$mid;
			$mrslt = $dbobject->query($mquery);
			$mrow = $mrslt->fetch_assoc();
			$nquery = "INSERT INTO notice (userid, content) ".
					"VALUES (".$uid.", '".$mrow["name"]."이 등록 취소되었습니다.')";
			$nrslt = $dbobject->query($nquery);
			if($nrslt == FALSE) {
				echo "알림 등록이 실패했지만 데이터는 정상 처리 되었습니다";
			}
			else {
				echo "ok";
			}
		}
		else {
			echo $dquery."/Query Error";
		}
	}
?>