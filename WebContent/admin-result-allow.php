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
		$squery2 = "SELECT count(*) as count FROM record ".
					"WHERE userid = ".$uid.
					" AND musicid = ".$mid.
					" AND authorized = 'Y'";
		$srslt2 = $dbobject->query($squery2);
		if($srslt2 == FALSE) {
			echo $squery2." / S-Query2 Failed";
			
		}
		else {
			$srow2 = $srslt2->fetch_assoc();
			if($srow2["count"] > 0) {
				$dquery = "DELETE FROM record ".
						"WHERE musicid = ".$mid.
						" AND userid = ".$uid.
						" AND authorized = 'Y'";
				$dbobject->query($dquery);
			}
		
			// 3. update autorized
			$uquery = "UPDATE record SET authorized='Y' WHERE id = ".$resultid;
			$urslt = $dbobject->query($uquery);
			if($urslt == FALSE) {
				echo $dquery2." / D-Query Failed";
			}
			else {
				// 4. update total
				// update total must moved to admin page
				$inquery2 = "UPDATE total SET".
								" r".$mid." = ".$srow["score"]*$level.
							" WHERE userid=".$uid;
					
				$in2rst = $dbobject->query($inquery2);
					
				if($in2rst == FALSE) {
					echo $inquery2." / I-Query Failed";
				}
				else {
					// 5. update notice
					$mquery = "SELECT * FROM music WHERE id=".$mid;
					$mrslt = $dbobject->query($mquery);
					if(mrslt == FALSE) {
						echo $mquery." / N-Query Failed";
					}
					else {
						$mrow = $mrslt->fetch_assoc();
						$nquery = "INSERT INTO notice (userid, content) ".
								"VALUES (".$uid.", '".$mrow["name"]."이 등록되었습니다.')";
						$nrslt = $dbobject->query($nquery);
						if(nrslt == FALSE) {
							echo "알림 등록이 실패했지만 데이터는 정상 처리 되었습니다";
						}
						else {
							echo "ok";
						}
					}
				}
			}
		}
	}
?>