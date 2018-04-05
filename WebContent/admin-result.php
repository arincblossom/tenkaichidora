<?php
	include_once 'dbconn.php';
	include_once 'header.php';
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
	    <script src="js/jquery-2.2.1.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script>
			var adminResultPrevScore = 0;
			
			function allowRecord(id, level, score) {
				checkCurrentScore(id);
				var prescore = adminResultPrevScore;
				if(score < prescore) {
					if(confirm("기존 점수보다 낮습니다. 업데이트 하시겠습니까?")) {
						updateScore(id, level);
					}
				}
				else {
					updateScore(id, level);
				}
			}
	
			function updateScore(id, level) {
				$.ajax({
					type:"POST",
					url:"admin-result-allow.php",
					data: {id:id, level:level},
					success: function(data) {
						if(data == "ok") {
							location.href = location.href;
						}
						else {
							alert(data);
						}
					}
				});
			}
			
			function disallowRecord(id) {
				$.ajax({
					type:"POST",
					url:"admin-result-disallow.php",
					data: {id:id},
					success: function(data) {
						if(data == "ok") {
							location.href = location.href;
						}
						else {
							alert(data);
						}
					}
				});
			}
			
			function checkCurrentScore(id) {
				$.ajax({
					type:"POST",
					url:"admin-result-checkscore.php",
					data: {id:id},
					async: false,
					success: function(data) {
						if(data != "fail") {
							adminResultPrevScore = data;
						}
						else {
							adminResultPrevScore = 0;
						}
					}
				});
			}
		</script>
	    <title>천하제일 도라대회</title>
	</head>
	<body role="document">
		<div class="container" role="main">
		<h1>관리자 페이지 - 성과 승인</h1>
		<div class="row">
			<div class="col-sm-12">
				<div class="div-table">
					<div class="div-table-header">
						<div class="div-table-cell">사용자</div>
						<div class="div-table-cell">곡</div>
						<div class="div-table-cell">성과</div>
						<div class="div-table-cell">사진</div>
						<div class="div-table-cell">등록시간</div>
						<div class="div-table-cell">승인/반려</div>
					</div>
					<?php
					$rquery = "SELECT
									p.name as username,
									m.name as musicname,
									m.dbsc as dbsc,
									m.dadv as dadv,
									m.dext as dext,
									m.dmas as dmas,
									m.inuse as inuse,
									r.id as recordid,
									r.score as score,
									r.appliedscore as appliedscore,
									r.img as img,
									r.time as time
								FROM members as p, music as m
								INNER JOIN
									(SELECT
										id,
										userid,
										musicid,
										score,
										appliedscore,
										img,
										time
									FROM record
									WHERE authorized = 'N') r
								WHERE p.id = r.userid
									AND r.musicid = m.id";
					$rslt = $dbobject->query($rquery);
					if($rslt != FALSE) {
						while($row = $rslt->fetch_assoc()) {
							$level;
							echo "<div class='div-table-row'>";
							echo "<div class='div-table-cell'>".
								$row["username"].
								"</div>";
							echo "<div class='div-table-cell'>".
								$row["musicname"];
								switch($row["inuse"]) {
									case "dbsc":
										echo " / BASIC";
										$level = $row["dbsc"];
										break;
									case "dadv":
										echo " / ADVANCED";
										$level = $row["dadv"];
										break;
									case "dext":
										echo " / EXTREME";
										$level = $row["dext"];
										break;
									case "dmas":
										echo " / MASTER";
										$level = $row["dmas"];
										break;
								}
								echo "</div>";
							echo "<div class='div-table-cell'>".
								"Score:".(int)$row["score"].
								"<br/>Calculated:".number_format($row["appliedscore"], 2, '.', '').
								"</div>";
							echo "<div class='div-table-cell'>".
									"<a href='".$row["img"].
									"' target='_blank'>링크</a>".
									"</div>";
							echo "<div class='div-table-cell'>".
									$row["time"].
									"</div>";
							echo "<div class='div-table-cell'>".
									"<a class='btn btn-default' onclick='allowRecord(".$row["recordid"].", ".(double)$level.", ".$level*$row["score"].")'>승인</a>".
									"<a class='btn btn-default' onclick='disallowRecord(".$row["recordid"].")'>반려</a>".
									"</div>";
							echo "</div>";
						}
					}
					else {
						echo $rquery;
						echo "QUERY FAIL";
					}
					?>
				</div>
			</div>
		</div>
	</div>
	</body>
</html>