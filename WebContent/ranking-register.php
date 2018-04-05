<?php
	include_once 'dbconn.php';
	include_once 'header.php';
	
	if(!isset($_SESSION["id"])) {
		echo "<script>location.href='/index.php';</script>";
	}
?>
<!-- TRIK competition page by Arin (roxyeris@gmail.com) / (c) 2016.05 -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="js/jquery-2.2.1.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script>
			if (!String.prototype.startsWith) {
			  String.prototype.startsWith = function(searchString, position) {
			    position = position || 0;
			    return this.indexOf(searchString, position) === position;
			  };
			}
			function send() {
				var run = false;
				var song = $("select").val();
				var score = $("input[name='score']").val();
				var imglink = $("input[name='imglink']").val();

				if(song != "" && imglink != "") {
					// ok
					run = true;
				}

				if(run) {
					$.ajax({
						type:"POST",
						url:"ranking-register-add.php",
						data: {
							song:song,
							score:score,
							imglink:imglink
						},
						success: function(data) {
							if(data.startsWith("ok")) {
								// 데이터 입력 성공
								var next = data.split("|");
								alert("기록 등록이 완료되었습니다. 관리자의 승인을 기다리세요");
								location.href="ranking-each.php?id="+next[1];
							}
							else {
								alert(data);
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
				<div class="col-xs-12"><h1>기록 등록 페이지</h1></div>
			</div>
			<form id="register" method="post" action="/ranking-register-add.php" enctype="multipart/form-data">
				<div class="container" style="border: 1px solid black; width:80%;">
					<div class="row" style="border-bottom: 1px solid #cccccc;">
						<div class="col-xs-6" style="padding-top:0.5%;">곡/난이도 선택</div>
						<div class="col-xs-6">
							<select name="song" form="register" class="form-control">
							<?php
							// run loop
							$query = "SELECT id, name, dbsc, dadv, dext, dmas, inuse FROM music WHERE inuse != 'N'";
							$qrst = $dbobject->query ( $query );
							if ($qrst != FALSE) {
								while($row = $qrst->fetch_assoc()) {
									if ($row ["inuse"] == "dbsc") {
										echo "<option value='".$row["id"]."'>".
											$row["name"]." / ".number_format ( $row ["dbsc"], 2 ).
											" / BASIC</option>";
									} else if ($row ["inuse"] == "dadv") {
										echo "<option value='".$row["id"]."'>".
											$row["name"]." / ".number_format ( $row ["dadv"], 2 ).
											" / ADVANCED</option>";
									} else if ($row ["inuse"] == "dext") {
										echo "<option value='".$row["id"]."'>".
											$row["name"]." / ".number_format ( $row ["dext"], 2 ).
											" / EXTREME</option>";
									} else if ($row ["inuse"] == "dmas") {
										echo "<option value='".$row["id"]."'>".
											$row["name"]." / ".number_format ( $row ["dmas"], 2 ).
											" / MASTER</option>";
									}
								}
							} else {
								echo "QUERY FAIL";
							}
							?>
							</select>
						</div>
					</div>
					<div class="row" style="border-bottom: 1px solid #cccccc;">
						<div class="col-xs-6" style="padding-top:0.5%;">점수</div>
						<div class="col-xs-6">
							<input type="text" name="score" class="form-control" />
						</div>
					</div>
					<div class="row" style="border-bottom: 1px solid #cccccc;">
						<div class="col-xs-6">이미지 링크 (http://포함, 트위터나 인스타그램도 가능)</div>
						<div class="col-xs-6">
							<input name="imglink" type="text" class="form-control" />
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