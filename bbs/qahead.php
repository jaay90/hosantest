<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$qa_skin_path = get_skin_path('qa', (G5_IS_MOBILE ? $qaconfig['qa_mobile_skin'] : $qaconfig['qa_skin']));
$qa_skin_url  = get_skin_url('qa', (G5_IS_MOBILE ? $qaconfig['qa_mobile_skin'] : $qaconfig['qa_skin']));

if (G5_IS_MOBILE) {
    // 모바일의 경우 설정을 따르지 않는다.
    include_once('./_head.php');
    echo conv_content($qaconfig['qa_mobile_content_head'], 1);
} else {
    if($qaconfig['qa_include_head'] && is_include_path_check($qaconfig['qa_include_head']))
        @include ($qaconfig['qa_include_head']);
    else
        include ('./_head.php');
    echo conv_content($qaconfig['qa_content_head'], 1);
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
        <li><a href="<?echo G5_URL?>/bbs/board.php?bo_table=notice">공지&뉴스</a></li>
        <?php if ($is_admin) {  ?>
        <li><a href="<?echo G5_URL?>/bbs/qalist.php" class="on">고객문의</a></li>
        <?}else{?>
        <li><a href="<?echo G5_URL?>/bbs/qawrite.php" class="on">고객문의</a></li>
        <?}?>
    </ul>