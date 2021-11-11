<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 게시판 관리의 상단 내용
if (G5_IS_MOBILE) {
    // 모바일의 경우 설정을 따르지 않는다.
    include_once(G5_BBS_PATH.'/_head.php');
    echo html_purifier(stripslashes($board['bo_mobile_content_head']));
} else {
    if($board['bo_include_head'] && is_include_path_check($board['bo_include_head'])) {  //파일경로 체크
        @include ($board['bo_include_head']);
    } else {    //파일경로가 올바르지 않으면 기본파일을 가져옴
        include_once(G5_BBS_PATH.'/_head.php');
    }
    echo html_purifier(stripslashes($board['bo_content_head']));
}
?>
<article class="conWrap"> 
<div class="pageTit sub03"> <!-- 대메뉴별 bg 클래스 sub0N -->
    <h2>고객센터</h2>
    <p class="subtitle">Every Day Hosan</p>
    <p class="sub01_text">호산물산(주)은 정직과 신뢰를 바탕으로 최고의 품질을 추구합니다. </p>
</div>
<div class="pageNavi">
    <h2 class="blind">현재 페이지 위치 안내</h2>
    <span class="home_ic"></span>
    <span>고객센터</span>
    공지&뉴스
</div>
<section class="contents">
    <ul class="pageLink pageLink5">
    <li><a href="<?echo G5_URL?>/bbs/board.php?bo_table=notice" class="on">공지&뉴스</a></li>
        <li><a href="<?echo G5_URL?>/bbs/formmail.php">고객문의</a></li>
    </ul>