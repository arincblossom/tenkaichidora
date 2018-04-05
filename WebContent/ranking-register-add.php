<?php
	// TRIK competition page by Arin (roxyeris@gmail.com) / (c) 2016.05
	include_once 'dbconn.php';
	
	$song = $_POST["song"];
	$score = $_POST["score"];
	$img = $_POST["imglink"];
	$level = 0;
	
	// get music info with name and level
	$mquery = "SELECT id, dbsc, dadv, dext, dmas, inuse ".
			"FROM music ".
			"WHERE id=".$song;
	
	$mrslt = $dbobject->query($mquery);
	if($mrslt != FALSE) {
		$mrow = $mrslt->fetch_assoc();
		
		if($mrow["inuse"] == "dbsc") {
			$level = $mrow["dbsc"];
		}
		else if($mrow["inuse"] == "dadv") {
			$level = $mrow["dadv"];
		}
		else if($mrow["inuse"] == "dext") {
			$level = $mrow["dext"];
		}
		else if($mrow["inuse"] == "dmas") {
			$level = $mrow["dmas"];
		}
		
		$inquery = "INSERT INTO record".
					" (userid, musicid, score, appliedscore, img, authorized)".
				" VALUES".
					" (".$_SESSION["id"].", ".$song.",".
					$score.", ".$score*$level.", '".$img."', 'N')";
					
		$in1rst = $dbobject->query($inquery);
		if($in1rst == FALSE) {
			echo $inquery."기록 업로드에 실패했습니다 (type 2)";
		}
		else {
			echo "ok|".$song;
		}
	}
	else {
		echo "기록 업로드에 실패했습니다 (type 1) query : ".$mquery;
	}
?>