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
					<h3>
					<?php
						$mid;
						$pid;
						$lv;
						// get song name and information
						$squery = "SELECT id, name, dbsc, dadv, dext, dmas FROM music WHERE id=".$_GET["id"];
						$sqrst = $dbobject->query ( $squery );
						if($sqrst != FALSE) {
							$sall = $sqrst->fetch_assoc();
							$mid = $sall["id"];
							echo $sall["name"]." / ";
							switch($_GET["pt"]) {
								case "9" :
									echo "BASIC(".number_format ($sall["dbsc"], 2).")";
									$lv = $sall["dbsc"];
									$pid = 9;
									break;
								case "10" :
									echo "ADVANCED(".number_format ($sall["dadv"], 2).")";
									$lv = $sall["dadv"];
									$pid = 10;
									break;
								case "11" :
									echo "EXTREME(".number_format ($sall["dext"], 2).")";
									$lv = $sall["dext"];
									$pid = 11;
									break;
								case "12" :
									echo "MASTER(".number_format ($sall["dmas"], 2).")";
									$lv = $sall["dmas"];
									$pid = 12;
									break;
							}
						}
					?>
					</h3>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-12">
					<p>환산 점수는 스코어 * 곡 난이도의 값입니다. 게임 점수를 누르면 성과 이미지를 확인할 수 있습니다.</p>
				</div>
			</div>
	
			<div class="row">
				<div class="col-xs-12">
					<div class="div-table">
						<div class="div-table-header">
							<div class="div-table-cell">순위</div>
							<div class="div-table-cell">닉네임</div>
							<div class="div-table-cell">게임 점수</div>
							<div class="div-table-cell">환산 점수</div>
							<div class="div-table-cell">등록 시간</div>
						</div>
							<?php
							// run loop
							$index = 1;
							$query = "SELECT
										p.name as name,
										r.score as score,
										r.appliedscore as appliedscore,
										r.img as img,
										r.time as time
									FROM members as p
									INNER JOIN
										(SELECT
											userid,
											score,
											appliedscore,
											img,
											DATE_ADD(time, INTERVAL 8 HOUR) as time
										FROM record
										WHERE musicid=".$mid."
											AND authorized = 'Y') r
									WHERE p.id = r.userid
									ORDER BY score DESC, time ASC";
							$qrst = $dbobject->query ( $query );
							if ($qrst != FALSE) {
								while($row = $qrst->fetch_assoc()) {
									echo "<div class='div-table-row'>";
									echo "<div class='div-table-cell'>".$index.
											"</div>";
									echo "<div class='div-table-cell'>".$row["name"]."</div>";
									echo "<div class='div-table-cell'><a target='_blank' href='".$row["img"]."'>".(int)$row["score"]."</a></div>";
									echo "<div class='div-table-cell'>".number_format($row["appliedscore"], 2, '.', '')."</div>";
									echo "<div class='div-table-cell'>".$row["time"]."</div>";
									echo "</div>";
									$index++;
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