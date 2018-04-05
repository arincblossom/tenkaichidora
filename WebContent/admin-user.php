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
		<h1>관리자 페이지 - 유저 관리</h1>
		<div class="row">
			<div class="col-sm-12">
				<div class="div-table">
					<div class="div-table-header">
						<div class="div-table-cell">이름</div>
						<div class="div-table-cell">상태 변경</div>
						<div class="div-table-cell">운영진 설정</div>
						<div class="div-table-cell">영구 삭제</div>
					</div>
					<?php
						$uquery = "SELECT * FROM members";
						$urslt = $dbobject->query($uquery);
						while($urow = $urslt->fetch_assoc()) {
							echo "<div class='div-table-row'>";
							echo "<div class='div-table-cell'>".
								$urow["name"].
								"</div>";
							
							// status
							echo "<div class='div-table-cell'>";
							if($urow["pause"] == "N") {
								echo "<a class='btn btn-default'".
										"href='#' onclick='pauseuser(".$urow[id].")'>일시정지".
										"</a>";
							}
							else {
								echo "<a class='btn btn-default'".
										"href='#' onclick='resumeuser(".$urow[id].")'>사용재개".
										"</a>";
							}
							echo "</div>";
							
							// admin
							echo "<div class='div-table-cell'>";
							if($urow["isadmin"] == "N") {
								echo "<a class='btn btn-default'".
										"href='#' onclick='addadmin(".$urow[id].")'>관리자 설정".
										"</a>";
							}
							else {
								echo "<a class='btn btn-default'".
										"href='#' onclick='deladmin(".$urow[id].")'>관리자 해제".
										"</a>";
							}
							echo "</div>";
							
							echo "<div class='div-table-cell'>".
									"<a class='btn btn-default'".
									"href='#' onclick='removeuser(".$urow[id].")'>유저삭제".
									"</a>".
								"</div>";
							echo "</div>";
						}
					?>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery-2.2.1.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		function pauseuser(id) {
			$.ajax({
				method:"post",
				url:"admin-user-pause.php",
				data: {id:id},
				success: function(data) {
					location.href=history.go(0);
				}
			});
		}

		function resumeuser(id) {
			$.ajax({
				method:"post",
				url:"admin-user-resume.php",
				data: {id:id},
				success: function(data) {
					location.href=history.go(0);
				}
			});
		}

		function removeuser(id) {
			if(confirm("정말로 삭제 합니까? 다시 복구할 수 없습니다")) {
				$.ajax({
					method:"post",
					url:"admin-user-remove.php",
					data: {id:id},
					success: function(data) {
						location.href=history.go(0);
					}
				});
			}
		}

		function addadmin(id) {
			$.ajax({
				method:"post",
				url:"admin-user-addadmin.php",
				data: {id:id},
				success: function(data) {
					location.href=history.go(0);
				}
			});
		}

		function deladmin(id) {
			$.ajax({
				method:"post",
				url:"admin-user-deladmin.php",
				data: {id:id},
				success: function(data) {
					location.href=history.go(0);
				}
			});
		}
	</script>
	</body>
</html>