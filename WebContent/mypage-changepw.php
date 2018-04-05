<?php
	include_once 'dbconn.php';
	include_once 'header.php';
	
	if(!isset($_SESSION["id"])) {
		echo "<script>location.href='/index.php';</script>";
	}
	
	$squery = "SELECT * FROM members WHERE id = ".$_SESSION["id"];
	$srslt = $dbobject->query($squery);
	$srow = $srslt->fetch_assoc();
	$id = $srow["textid"];
?>
<!-- TRIK competition page by Arin (roxyeris@gmail.com) / (c) 2016.05 -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
	    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
	    <link href="css/custom.css" rel="stylesheet">
	    <title>천하제일 도라대회</title>
	</head>
	<body role="document">
		<div class="container" role="main">
		<form class="form-signin">
			<h2 class="form-signin-heading">비밀번호 변경</h2>
			<label for="inputEmail" class="sr-only">ID</label>
			<input
				type="text" id="id" class="form-control"
				placeholder="ID" required value="<?php echo $id; ?>" readonly>
			<label for="inputPassword" class="sr-only">변경할 비밀번호</label>
			<input
				type="password" id="passwd" class="form-control"
				placeholder="바꿀 Secret Code" required autofocus>
			<button class="btn btn-lg btn-primary btn-block" type="button" onclick="changePW()">
				비밀번호 변경
			</button>
			<button class="btn btn-lg btn-default btn-block" type="button" onclick="cancelPW()">
				취소
			</button>
		</form>
	</div>
	<script src="js/jquery-2.2.1.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/sha.js"></script>
	<script>
		function shaEncrypt(data) {
			var shaObj = new jsSHA("SHA-256", "TEXT");
		    shaObj.update(data);
		    return shaObj.getHash("HEX");
		}
		
		function changePW(id) {
			var id = $("#id").val();
			var sc = shaEncrypt($("#passwd").val());

			$.ajax({
				type:"POST",
				url:"mypage-changepw-submit.php",
				data: {
					id:id,
					sc:sc
				},
				success: function(data) {
					if(data == "ok") {
						// move to page
						location.href="ranking-all.php";
					}
					else {
						alert(data);
					}
				}
			});
		}
		
		function mreg() {
			location.href="member-register.php";
		}
	</script>
	</body>
</html>