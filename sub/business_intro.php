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
			CEO 인사말
		</div>
		<section class="contents">
			<ul class="pageLink">
				<li><a href="<?echo G5_URL?>/sub/business_intro.php" class="on">CEO 인사말</a></li>
				<li><a href="<?echo G5_URL?>/sub/history.php">연혁</a></li>
				<li><a href="<?echo G5_URL?>/sub/pr_video.php">홍보영상</a></li>
				<li><a href="<?echo G5_URL?>/sub/partner.php">주요 관계사</a></li>
			</ul>

			<div class="con_textarea">				
				<p class="subTit">파트너를 위한 '신념'</p>
				<p class="pType">
					‘정직’과 ‘신뢰’는 호산물산㈜의 기본 정신으로, 이는 우리 소중한 파트너들과 오랜기간<br>비즈니스를 유지해 온 바탕이 되었으며, 향후 어떤 상황에서도 변함없을 것입니다. 
				</p>
				<p class="subTit" >소비자를 위한 '헌신' </p>
				<p class="pType">
					건강하고 우수한 한국 식품을 소비자에게 공급하기 위해 항상 최선을 다해왔으며,<br>앞으로도 소비자의 건강하고 행복한 삶을 위한 우리의 노력은 끊임없이 지속될 것입니다.  
				</p>
				<p class="subTit" >한국 식품의 세계화를 위한 '열정'</p>
				<p class="pType">
					1994년 창립이래 40개 이상의 국가에 한국 식품을 소개해왔으며, 세계 모든 나라에<br>한국 식품을 널리 알리기 위한 우리의 헌신과 열정은 계속될 것입니다.
				</p>
				<p class="subTit2">호산물산㈜는 항상 준비되어 있으며, 여러분과 함께 하기를 진심으로 바랍니다. </p>
				<p class="textbold">함께 해주십시오!  Let's go together!</p>
			</div>
		</section>
	</article>
	<!-- E: CONTENTS -->
    <?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>