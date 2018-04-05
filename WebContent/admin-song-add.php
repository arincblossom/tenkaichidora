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
	    <title>천하제일 도라대회</title>
	</head>
	<body role="document">
		<div class="container" role="main">
		<h1>관리자 페이지 - 노래 추가</h1>
		
		<div class="row">
			<div class="col-sm-12">
				전곡을 표시합니다. CTRL+F로 검색하여 패턴을 추가하세요
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="div-table">
					<div class="div-table-header">
						<div class="div-table-cell">제목</div>
						<div class="div-table-cell">버전</div>
						<div class="div-table-cell">난이도</div>
						<div class="div-table-cell">추가</div>
					</div>
					<?php
						$query = "SELECT id, name, version, dbsc, dadv, dext, dmas, inuse FROM music WHERE inuse = 'N'";
						$qrst = $dbobject->query ( $query );
						if ($qrst != FALSE) {
							while($row = $qrst->fetch_assoc()) {
								$levelb = (double)$row ["dbsc"];
								$levela = (double)$row ["dadv"];
								$levele = (double)$row ["dext"];
								$levelm = (double)$row ["dmas"];
								
								echo "<div class='div-table-row'>";
								echo "<div class='div-table-cell'>".$row["name"]."</div>";
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
								echo "<div class='div-table-cell'>";
								
								if($levelb > 0) {
									echo "Basic - ".$levelb."<br/>";
								}
								if($levela > 0) {
									echo "Advanced - ".$levela."<br/>";
								}
								if($levele > 0) {
									echo "Extreme - ".$levele."<br/>";
								}
								if($levelm > 0) {
									echo "Master - ".$levelm."<br/>";
								}
								
								echo "</div>";
								echo "<div class='div-table-cell'>";
								if($levelb > 0) {
									echo "<a href='#' style='width:100%;' class='btn btn-default' onclick='addone(".$row["id"].", 9)'>Basic 추가</a>";
								}
								if($levela > 0) {
									echo "<a href='#' style='width:100%;' class='btn btn-default' onclick='addone(".$row["id"].", 10)'>Advanced 추가</a>";
								}
								if($levele > 0) {
									echo "<a href='#' style='width:100%;' class='btn btn-default' onclick='addone(".$row["id"].", 11)'>Extreme 추가</a>";
								}
								if($levelm > 0) {
									echo "<a href='#' style='width:100%;' class='btn btn-default' onclick='addone(".$row["id"].", 12)'>Master 추가</a>";
								}
								echo "</div>";
								echo "</div>";
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery-2.2.1.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/sha.js"></script>
	<script>
		function addone(mid, ptid) {
			$.ajax({
				method:"post",
				url:"admin-song-add-work.php",
				data:{mid:mid, ptid:ptid},
				success:function(data) {
					if(data == "ok") {
						alert("곡이 추가되었습니다");
						location.href = history.go(0);
					}
					else {
						alert(data);
					}
				}
			});
		}
	</script>
	</body>
</html>