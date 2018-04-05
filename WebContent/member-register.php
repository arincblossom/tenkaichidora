<?php
	include_once 'dbconn.php';
	include_once 'header.php';

	if(isset($_SESSION["id"])) {
		echo "<script>location.href='/totalrank.php';</script>";
	}
	// TRIK competition page by Arin (roxyeris@gmail.com) / (c) 2016.05
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="js/jquery-2.2.1.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/sha.js"></script>
		<script>
			function shaEncrypt(data) {
				var shaObj = new jsSHA("SHA-256", "TEXT");
			    shaObj.update(data);
			    return shaObj.getHash("HEX");
			}
		
			function send() {
				var id = $("input[name='id']").val();
				var sc = $("input[name='passwd']").val();
				var name = $("input[name='name']").val();

				if(id != "" && sc != "" && name != "") {
					// ok
					run = true;
				}

				if(run) {
					sc = shaEncrypt(sc);
					$.ajax({
						type: "POST",
						url: "member-add.php",
						data: {
							id: id,
							sc: sc,
							name: name
						},
						success: function(data) {
							if(data != "ok") {
								alert(data);
							}
							else {
								alert("등록이 완료되었습니다.");
								location.href = "ranking-all.php";
							}
						}
					});
				}
				else {
					alert("모든 항목이 채워지지 않았습니다");
				}
			}

			function reset() {
				$("#register").each(function() {
					this.reset();
				});
			}
		</script>
	    <link href="css/bootstrap.min.css" rel="stylesheet">
	    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
	    <link href="css/custom.css" rel="stylesheet">
	    <title>천하제일 도라대회</title>
	</head>
	<body role="document">
		<div class="container" role="main">
			<div class="row">
				<div class="col-xs-12"><h1>회원 가입</h1></div>
				<p style="color:red;"><b>비밀 번호는 되도록 기존에 쓰던 것과는 다르게 간단하고 털려도 문제 없는걸로 (...) 해주세요</b></p>
				<p>물론 암호화해서 저장합니다만.. 그래도... 모릅니다 ㅠㅠ</p>
			</div>
			<form id="register">
				<div class="container" style="border: 1px solid black; width:80%;">
					<div class="row" style="border-bottom: 1px solid #cccccc;">
						<div class="col-xs-6" style="padding-top:0.5%;">ID</div>
						<div class="col-xs-6">
							<input type="text" name="id" class="form-control" />
						</div>
					</div>
					<div class="row" style="border-bottom: 1px solid #cccccc;">
						<div class="col-xs-6" style="padding-top:0.5%;">Secret Code</div>
						<div class="col-xs-6">
							<input type="password" name="passwd" class="form-control" />
						</div>
					</div>
					<div class="row" style="border-bottom: 1px solid #cccccc;">
						<div class="col-xs-6" style="padding-top:0.5%;">게임 이름</div>
						<div class="col-xs-6">
							<input type="text" name="name" class="form-control" />
						</div>
					</div>
					<div class="row" style="text-align:center;">
						<a class='col-xs-6 btn btn-primary' href='#' onclick='send()'>등록</a>
						<a class='col-xs-6 btn btn-default' href='#' onclick='reset()'>다시 쓰기</a>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>