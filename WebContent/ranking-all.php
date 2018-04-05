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
					<h1>예선 토탈 랭킹</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<p>곡 제목을 클릭하면 각 곡별 랭킹을 볼 수 있습니다</p>
					<p>괄호는 환산 전 본래 점수이며 클릭 시 성과사진을 볼 수 있습니다</p>
				</div>
			</div>
	
			<div class="row">
				<div class="col-xs-12">
					<div class="div-table">
						<div class="div-table-header">
							<div class="div-table-cell">순위</div>
							<div class="div-table-cell">이름</div>
							<?php
							$mid = array();
							$mlv = array();
							// run loop
							$query = "SELECT id, name, version, dbsc, dadv, dext, dmas, inuse FROM music WHERE inuse != 'N'";
							$qrst = $dbobject->query ( $query );
							if ($qrst != FALSE) {
								while($row = $qrst->fetch_assoc()) {
									echo "<div class='div-table-cell'>".
											"<a href='/ranking-each.php?id=".$row["id"].
											"&pt=";
									if($row["inuse"] == "dbsc") {
										echo 9;
									}
									if($row["inuse"] == "dadv") {
										echo 10;
									}
									if($row["inuse"] == "dext") {
										echo 11;
									}
									if($row["inuse"] == "dmas") {
										echo 12;
									}
									echo "'>".$row["name"] . "</a></div>";
									array_push($mid, $row["id"]);
									
									$addlv;
									if ($row ["inuse"] == "dbsc") {
										$addlv = $row ["dbsc"];
									} else if ($row ["inuse"] == "dadv") {
										$addlv = $row ["dadv"];
									} else if ($row ["inuse"] == "dext") {
										$addlv = $row ["dext"];
									} else if ($row ["inuse"] == "dmas") {
										$addlv = $row ["dmas"];
									}
									array_push($mlv, $addlv);
								}
							} else {
								echo "QUERY FAIL";
							}
							?>
							<div class="div-table-cell">총점</div>
						</div>
						<?php
						// get score for each person and create rank
						$tquery = "SELECT * FROM total ORDER BY ";
						for($i = 0; $i < count($mid); $i++) {
							if($i != count($mid)-1) {
								$tquery = $tquery."r".$mid[$i]."+";
							}
							else {
								$tquery = $tquery."r".$mid[$i];
							}
						}
						$tquery = $tquery." DESC";
						$tqrst = $dbobject->query($tquery);
						$rank = 1;
						if($tqrst != FALSE) {
							while($trow = $tqrst->fetch_assoc()) {
								echo "<div class='div-table-row'>";
								echo "<div class='div-table-cell'>".
										$rank."</div>";
								$usersum = 0;
								echo "<div class='div-table-cell'>".
										$trow["name"]."</div>";
								for($i = 0; $i < count($mid); $i++) {
									$squery = "SELECT * FROM record WHERE userid = ".$trow["userid"].
												" AND musicid = ".$mid[$i];
									$srslt = $dbobject->query($squery);
									if($srslt == FALSE) {
										echo "개별 기록 정보를 가져오지 못했습니다".$squery;
									}
									else {
										$srow = $srslt->fetch_assoc();
										
										// 점수 표시 수정 필요
										echo "<div class='div-table-cell'>".
												number_format($trow["r".$mid[$i]], 2, '.', '').
												"<br/><a target='_blank' href='".$srow["img"]."'>(".
												number_format($srow["score"], 0, '', '').")</a></div>";
										$usersum += $trow["r".$mid[$i]];
									}
								}
								echo "<div class='div-table-cell'>".
										number_format($usersum, 2, '.', '')."</div>";
								echo "</div>";
								$rank++;
							}
						}
						else {
							echo "점수 정보를 가져오지 못했습니다";
						}
						?>
					</div>
				</div>
			</div>
	
		</div>
	</body>
</html>