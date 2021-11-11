<?php
include_once('./_common.php');

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>
		<!-- S: CONTENTS -->
		<article class="conWrap"> 
			<div class="pageTit">
				<h2>회사소개</h2>
				<p class="subtitle">Every Day Hosan</p>
				<p class="sub01_text">한국식품의 세계화, 호산이 더 건강한 미래를 향해 나아갑니다.</p>
			</div>
			<div class="pageNavi">
				<h2 class="blind">현재 페이지 위치 안내</h2>
				<span class="home_ic"></span>
				<span>회사소개</span>
				홍보영상
			</div>
			<section class="contents">
            <ul class="pageLink">
				<li><a href="<?echo G5_URL?>/sub/business_intro.php">CEO 인사말</a></li>
				<li><a href="<?echo G5_URL?>/sub/history.php">연혁</a></li>
				<li><a href="<?echo G5_URL?>/sub/pr_video.php" class="on">홍보영상</a></li>
				<li><a href="<?echo G5_URL?>/sub/partner.php">주요 관계사</a></li>
			</ul>

				<div class="video-wrap">
						<iframe src="https://www.youtube.com/embed/qV4Kc5A4zoE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						<iframe src="https://www.youtube.com/embed/qC-mpnasrcI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					
				</div>
			</section>
		</article>
		<!-- E: CONTENTS -->
        <?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>