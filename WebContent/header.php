<?php
	include_once 'dbconn.php';
	$myid = $_SESSION["id"];
	$noticeExist = false;
	$isAdmin;
	
	$headQuery = "SELECT * FROM notice WHERE userid = ".$myid;
	$headRslt = $dbobject->query($headQuery);
	if($headRslt != FALSE && $headRslt->num_rows > 0) {
		echo "<div style='position:absolute; top:70px; left:30px;".
			" background-color:rgba(0,0,0,0.7); color:white; padding:10px;".
			" width: 300px; border:1px solid grey; z-index:100;'>";
		echo "<b>새로운 알림이 있습니다</b><br/>";
		while($headRow = $headRslt->fetch_assoc()) {
			echo $headRow["content"].
			$content."<a href='#' onclick='removeHeader(".$headRow["id"].")'>".
			"<b>삭제</b></a><br/>";
		}
		echo "</div>";
	}
	
	$memberQuery = "SELECT * FROM members WHERE id = ".$myid;
	$memRslt = $dbobject->query($memberQuery);
	if($memRslt == FALSE) {
		$isAdmin = "N";
	}
	else {
		$memRows = $memRslt->fetch_assoc();
		$isAdmin = $memRows["isadmin"];
	}
?>
<div style="padding: 20px;">
	<div>
		<div>
			<h2><img src="img/logo_big.png" width="150px" height="57px" /><b>천하제일 도라대회</b></h2>
			<h5>드럼매니아 대회 기록관리 페이지입니다. Powered by GITADORA Info (Dev/<a href="http://twitter.com/prunusarin/">@prunusArin</a>)</h5>
		</div>
		<hr/>
		<div class="row">
			<div class="col-sm-2" style="text-align:center;"><a class="headerlink" href="http://bloody-k.com/wp/gitadora/">대회안내</a></div>
			<div class="col-sm-2" style="text-align:center;"><a class="headerlink" href="/index.php">랭킹 페이지</a></div>
			<div class="col-sm-2" style="text-align:center;"><a class="headerlink" href="http://bloody-k.com/wp/gitadora/?p=107">대회 스케줄</a></div>
			<div class="col-sm-2" style="text-align:center;"><a class="headerlink" href="http://bloody-k.com/wp/gitadora/?p=109">예선 규칙 및 등록방법</a></div>
			<div class="col-sm-2" style="text-align:center;"><a class="headerlink" href="http://bloody-k.com/wp/gitadora/?p=111">참가접수</a></div>
			<div class="col-sm-2" style="text-align:center;"><a class="headerlink" href="http://bloody-k.com/wp/gitadora/?p=114">토너먼트 안내</a></div>
		</div>
		<div class="row">
			<div class="col-sm-2" style="text-align:center;"><a class="headerlink" href="/ranking-register.php">기록 등록하기</a></div>
			<div class="col-sm-2" style="text-align:center;"><a class="headerlink" href="/ranking-musiclist.php">곡별 기록보기</a></div>
			<div class="col-sm-2" style="text-align:center;"><a class="headerlink" href="/ranking-all.php">종합 기록보기</a></div>
			<div class="col-sm-2" style="text-align:center;"><a class="headerlink" href="/mypage-changepw.php">비밀번호 변경</a></div>
			<div class="col-sm-2" style="text-align:center;">
				<?php
				if($isAdmin == "Y") {
					echo "<a class='headerlink' href='/admin.php'>관리자페이지</a>";
				}
				?>
			</div>
			<div class="col-sm-2" style="text-align:center;">
				<?php
				if(isset($_SESSION["id"])) {
					echo "<a class='headerlink' href='/logout.php'>로그아웃</a>";
				}
				?>
			</div>
		</div>
		<!--/.nav-collapse -->
		<hr/>
	</div>
</div>

<script>
	function removeHeader(id) {
		$.ajax({
			method:"post",
			url:"header-noticeremove.php",
			data: {id:id},
			success: function(data) {
				if(data == "ok") {
					history.go(0);
				}
				else {
					alert(data);
				}
			}
		});
	}
</script>