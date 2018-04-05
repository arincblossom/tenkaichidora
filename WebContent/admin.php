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
		<link href="css/bootstrap.min.css" rel="stylesheet">
	    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
	    <link href="css/custom.css" rel="stylesheet">
	    <title>천하제일 도라대회</title>
	</head>
	<body role="document">
		<div class="container" role="main">
		<h1>관리자 페이지</h1>
		<div class="row">
			<div class="col-sm-6">
				<a class="btn btn-default" style="width:100%;" href="admin-user.php">유저 관리</a>
			</div>
			<div class="col-sm-6">
				<a class="btn btn-default" style="width:100%;" href="admin-song.php">대상곡 관리</a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<a class="btn btn-default" style="width:100%;" href="admin-result.php">성과 승인 관리</a>
			</div>
			<div class="col-sm-6">
				<a class="btn btn-default" style="width:100%;" href="admin-record.php">등록된 성과 관리</a>
			</div>
		</div>
	</div>
	<script src="js/jquery-2.2.1.js"></script>
	<script src="js/bootstrap.min.js"></script>
	</body>
</html>