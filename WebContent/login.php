<?php
	include_once 'dbconn.php';
	
	$id = $_POST["lid"];
	$sc = $_POST["lsc"];
	
	$loginq = "SELECT * FROM members WHERE textid='".$id."' AND sc=PASSWORD('".$sc."')";
	$loginr = $dbobject->query($loginq);
	if($loginr->num_rows == 0) {
		echo "로그인에 실패하였습니다";
		unset($_SESSION["id"]);
	}
	else {
		// register session data
		$rst = $loginr->fetch_assoc();
		$_SESSION["id"] = $rst["id"];
		echo "ok";
	}
?>