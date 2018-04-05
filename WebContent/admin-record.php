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
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.min.css" rel="stylesheet">
		<link href="css/custom.css" rel="stylesheet">
		
		<script>
			function removeRecord(id, mid, uid) {
				if(confirm("기록을 삭제하시겠습니까? 복구할 수 없습니다")) {
					$.ajax({
						method:"post",
						url:"admin-record-remove.php",
						data:{id:id, mid:mid, uid:uid},
						success:function(data) {
							if(data == "ok") {
								alert("처리가 완료되었습니다");
								location.href=location.href;
							}
							else {
								alert(data);
							}
						}
					});
				}
			}
		</script>
	    <title>천하제일 도라대회</title>
	</head>
	<body role="document">
		<div class="container" role="main">
			<div class="row">
				<div class="col-xs-12">
					<h1>등록된 기록들</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<p>환산 점수는 스코어 * 곡 난이도의 값입니다.</p>
				</div>
			</div>
	
			<div class="row">
				<div class="col-xs-12">
					<div class="div-table">
						<div class="div-table-header">
							<div class="div-table-cell">닉네임</div>
							<div class="div-table-cell">곡명/난이도</div>
							<div class="div-table-cell">게임 점수</div>
							<div class="div-table-cell">환산 점수</div>
							<div class="div-table-cell">사진 보기</div>
							<div class="div-table-cell">등록 시간</div>
							<div class="div-table-cell">수정/삭제</div>
						</div>
							<?php
							// run loop
							$query = "SELECT ".
										"p.name as username, ".
										"m.name as musicname, ".
										"m.inuse as pattern, ".
										"r.id as resultid, ".
										"r.musicid as musicid, ".
										"r.userid as userid, ".
										"r.score as score, ".
										"r.appliedscore as appliedscore, ".
										"r.img as img, ".
										"r.time as time ".
									"FROM members as p, music as m ".
									"INNER JOIN ".
										"(SELECT ".
											"id, userid, musicid, score, appliedscore, img, ".
											"DATE_ADD(time, INTERVAL 8 HOUR) as time ".
										"FROM record ".
										"WHERE authorized = 'Y') r ".
									"WHERE p.id = r.userid ".
										"AND r.musicid = m.id ".
									"ORDER BY time DESC";
							$qrst = $dbobject->query ( $query );
							if ($qrst != FALSE) {
								while($row = $qrst->fetch_assoc()) {
									echo "<div class='div-table-row'>";
									echo "<div class='div-table-cell'>".$row["username"]."</div>";
									echo "<div class='div-table-cell'>";
										echo $row["musicname"];
										if($row["pattern"] == "dbsc") {
											echo " / Basic";
										}
										else if($row["pattern"] == "dadv") {
											echo " / Advanced";
										}
										else if($row["pattern"] == "dext") {
											echo " / Extreme";
										}
										else if($row["pattern"] == "dmas") {
											echo " / Master";
										}
									echo "</div>";
									echo "<div class='div-table-cell'>".(int)$row["score"]."</div>";
									echo "<div class='div-table-cell'>".number_format($row["appliedscore"], 2, '.', '')."</div>";
									echo "<div class='div-table-cell'><a href='".$row["img"]."'>이미지 링크</a></div>";
									echo "<div class='div-table-cell'>".$row["time"]."</div>";
									echo "<div class='div-table-cell'>";
										echo "<a class='btn btn-default' href='#' onclick='removeRecord(".$row["resultid"].", ".$row["musicid"].", ".$row["userid"].")'>삭제</a>";
									echo "</div>";
									echo "</div>";
								}
							} else {
								echo "QUERY FAIL";
							}
							?>
						</div>
				</div>
			</div>
		</div>
	</body>
</html>