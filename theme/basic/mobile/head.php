<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(G5_COMMUNITY_USE === false) {
    define('G5_IS_COMMUNITY_PAGE', true);
    include_once(G5_THEME_SHOP_PATH.'/shop.head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>
<header id="header">
<!-- S: GNB -->
	<div class="nav_wrapper"> 
		<!--hamburger menu-->
		<div class="spinner-master">
		  <a class="nav-toggle" href="#"><span></span></a>
		</div>
		<h1 class="main_logo">
		  <a href="<?echo G5_URL?>/index.php"></a>
		</h1>
		<!--네비-->
		<nav id="gnb" class="gnb">
		  <ul>
		    <li><a href="<?echo G5_URL?>/sub/business_intro.php" title="">회사소개</a>
		      <ul class="submenu">
		        <li><a href="<?echo G5_URL?>/sub/business_intro.php" title="">CEO 인사말</a></li>
		        <li><a href="<?echo G5_URL?>/sub/history.php" title="">연혁</a></li>
		        <li><a href="<?echo G5_URL?>/sub/pr_video.php" title="">홍보영상</a></li>
		        <li><a href="<?echo G5_URL?>/sub/partner.php" title="">주요 관계사</a></li>
		      </ul>
		    </li>
		    <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&position=on'?>" title="">제품소개</a>
		      <ul class="submenu">
		        <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&position=on'?>" title="">A+ Hosan<span>&ensp;»</span></a>
		          <ul>
		            <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&position=on'?>" title="">신제품</a></li>
		            <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=음료류'?>#" title="">음료류</a></li>
		            <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=김류'?>" title="">김류</a></li>
		            <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=국수류'?>" title="">국수류</a></li>
		            <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=우동류'?>" title="">우동류</a></li>
		            <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=차류'?>" title="">차류</a></li>
		            <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=냉동가공식품류'?>" title="">냉동가공식품류</a></li>
		            <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=냉동수산물'?>" title="">냉동수산물</a></li>
		            <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=김치'?>" title="">김치</a></li>
		            <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=기타'?>" title="">기타</a></li>
		          </ul>
		        </li>
		        <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=2&cate2=과자'?>" title="">National Brand<span>&ensp;»</span></a>
		          <ul>
		            <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=2&cate2=과자'?>" title="">과자</a></li>
		            <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=2&cate2=인스턴트 라면(팩/컵/봉지)'?>" title="">인스턴트 라면<br>(팩/컵/봉지)</a></li>
		            <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=2&cate2=소스'?>" title="">소스</a></li>
		            <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=2&cate2=기타'?>" title="">기타</a></li>            
		          </ul>
		        </li>
		      </ul>
		    </li>
		    
		    <li><a href="./sub/notice_list.php" title="">고객센터</a>
		      <ul class="submenu">
		        <li><a href="<?echo G5_URL?>/bbs/board.php?bo_table=notice" title="">공지&뉴스</a></li>
                <li><a href="<?echo G5_URL?>/bbs/formmail.php" title="">고객문의</a></li>                    
		      </ul>
		    </li>
		    <li class="lang"><a href="#" title="" class="on">한국어</a></li>
		    <li class="lang"><a href="#" title="">ENG</a></li>
		    <li class="lang"><a href="#" title="">中文</a></li>
		  </ul>
		</nav>
	</div>
<!-- E: GNB -->
</header>