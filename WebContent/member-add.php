<?php
	include_once 'dbconn.php';
	
	// TRIK competition page by Arin (roxyeris@gmail.com) / (c) 2016.05
	
	$id = $_POST["id"];
	$sc = $_POST["sc"];
	$name = $_POST["name"];
	
	$inquery = "INSERT INTO members
				(textid, sc, name)
			VALUES
				('".$id."', PASSWORD('".$sc."'), '".$name."')";
	
	$qmrst = $dbobject->query($inquery);
	if($qmrst == FALSE) {
		// 중복된 아이디 존재
		echo "중복된 아이디가 이미 존재합니다";
	}
	else {
		// get userid (integer)
		$idquery = "SELECT * FROM members WHERE textid = '".$id."'";
		$idrst = $dbobject->query($idquery);
		$idarr = $idrst->fetch_assoc();
		$id = $idarr["id"];
		
		// add into total
		$inquery2 = "INSERT INTO total
						(userid, name)
					VALUES
						(".$id.", '".$name."')";
		
		$totalrst = $dbobject->query($inquery2);
		
		if($totalrst == FALSE) {
			echo "등록에 실패했습니다. 관리자에게 문의해주세요";
		}
		else {
			echo "ok";
		}
	}
?>