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
		<h1>관리자 페이지 - 대회용 노래 목록 관리</h1>
		
		<div class="row">
			<div class="col-xs-12">
				<a href="admin-song-add.php" class="btn btn-default" style="width:100%;">패턴 추가</a>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12">
				<div class="div-table">
					<div class="div-table-header">
						<div class="div-table-cell">제목</div>
						<div class="div-table-cell">버전</div>
						<div class="div-table-cell">난이도</div>
						<div class="div-table-cell">삭제</div>
					</div>
					<?php
						$level;
						$query = "SELECT id, name, version, dbsc, dadv, dext, dmas, inuse FROM music WHERE inuse != 'N'";
						$qrst = $dbobject->query ( $query );
						if ($qrst != FALSE) {
							while($row = $qrst->fetch_assoc()) {
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
								echo "<div class='div-table-cell'><a href='#' class='btn btn-default' onclick='removeone(".$row["id"].")'>삭제</a></div>";
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
		function removeone(mid) {
			if(confirm("곡을 삭제하면 저장된 기록도 모두 삭제됩니다. 진행합니까?")) {
				$.ajax({
					method:"post",
					url:"admin-song-remove.php",
					data:{mid:mid},
					success:function(data) {
						if(data == "ok") {
							alert("곡이 삭제되었습니다");
							location.href = history.go(0);
						}
						else {
							alert(data);
						}
					}
				});
			}
		}
	</script>
	</body>
</html>