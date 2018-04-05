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
	    <title>천하제일 도라대회</title>
	</head>
	<body role="document">
		<div class="container" role="main">
			<div class="row">
				<div class="col-xs-12">
					<h1>예선 랭킹 보기</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<p>각 노래의 제목을 클릭하면 대회 대상곡들의 기록을 볼 수 있습니다</p>
				</div>
			</div>
	
			<div class="row">
				<div class="col-xs-12">
					<div class="div-table">
						<div class="div-table-header">
							<div class="div-table-cell">곡명</div>
							<div class="div-table-cell">난이도</div>
							<div class="div-table-cell">버전</div>
						</div>
							<?php
							// run loop
							$diff;
							$query = "SELECT id, name, version, dbsc, dadv, dext, dmas, inuse FROM music WHERE inuse != 'N'";
							$qrst = $dbobject->query ( $query );
							if ($qrst != FALSE) {
								while($row = $qrst->fetch_assoc()) {
									if ($row ["inuse"] == "dbsc") {
										$diff = 9;
									} else if ($row ["inuse"] == "dadv") {
										$diff = 10;
									} else if ($row ["inuse"] == "dext") {
										$diff = 11;
									} else if ($row ["inuse"] == "dmas") {
										$diff = 12;
									}
									
									echo "<div class='div-table-row'>";
									echo "<div class='div-table-cell'>".
											"<a href='/ranking-each.php?id=".$row["id"]."'>".
											$row["name"] . "</a></div>";
									echo "<div class='div-table-cell'>";
									if ($row ["inuse"] == "dbsc") {
										echo number_format ( $row ["dbsc"], 2 ) . " / BASIC";
									} else if ($row ["inuse"] == "dadv") {
										echo number_format ( $row ["dadv"], 2 ) . " / ADVANCED";
									} else if ($row ["inuse"] == "dext") {
										echo number_format ( $row ["dext"], 2 ) . " / EXTREME";
									} else if ($row ["inuse"] == "dmas") {
										echo number_format ( $row ["dmas"], 2 ) . " / MASTER";
									}
									echo "</div>";
									
									echo "<div class='div-table-cell'>";
									switch ($row ["version"]) {
										case 1 :
											echo "GuitarFreaks 1st";
											break;
										case 2 :
											echo "GuitarFreaks 2nd<br/>drummania 1st";
											break;
										case 3 :
											echo "GuitarFreaks 3rd<br/>drummania 2nd";
											break;
										case 4 :
											echo "GuitarFreaks 4th<br/>drummania 3rd";
											break;
										case 5 :
											echo "GuitarFreaks 5th<br/>drummania 4th";
											break;
										case 6 :
											echo "GuitarFreaks 6th<br/>drummania 5th";
											break;
										case 7 :
											echo "GuitarFreaks 7th<br/>drummania 6th";
											break;
										case 8 :
											echo "GuitarFreaks 8th<br/>drummania 7th";
											break;
										case 9 :
											echo "GuitarFreaks 9th<br/>drummania 8th";
											break;
										case 10 :
											echo "GuitarFreaks 10th<br/>drummania 9th";
											break;
										case 11 :
											echo "GuitarFreaks 11th<br/>drummania 10th";
											break;
										case 12 :
											echo "ee'mall";
											break;
										case 13 :
											echo "GuitarFreaks/DrumMania V";
											break;
										case 14 :
											echo "GuitarFreaks/DrumMania V2";
											break;
										case 15 :
											echo "GuitarFreaks/DrumMania V3";
											break;
										case 16 :
											echo "GuitarFreaks/DrumMania V4";
											break;
										case 17 :
											echo "GuitarFreaks/DrumMania V5";
											break;
										case 18 :
											echo "GuitarFreaks/DrumMania V6";
											break;
										case 19 :
											echo "GuitarFreaks/DrumMania XG";
											break;
										case 20 :
											echo "GuitarFreaks/DrumMania XG2";
											break;
										case 21 :
											echo "GuitarFreaks/DrumMania XG3";
											break;
										case 22 :
											echo "GITADORA";
											break;
										case 23 :
											echo "GITADORA OverDrive";
											break;
										case 24 :
											echo "GITADORA Tri-Boost";
											break;
									}
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