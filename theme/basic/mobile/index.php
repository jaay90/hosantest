<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_MSHOP_PATH.'/index.php');
    return;
}

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>

<!-- 메인화면 최신글 시작 -->
<!-- S: CONTENTS -->
<article id="main">
    <h2 class="blind">본문 입니다. 다음은 슬라이드가 나옵니다</h2>
    <div class="swiper-container">
      <div class="center-do-not-use">
        <div class="mouse">
          <div class="wheel"></div>
        </div>
        <div>
          <span class="arrow"></span>
        </div>
      </div>
      <div class="swiper-navigation">
        <div class="swiper-button-prev"><span></span></div>
        <div class="swiper-button-next"><span></span></div>
     </div>
      <div class="swiper-wrapper">
        <div class="swiper-slide slide01" data-swiper-autoplay="5000">
          <!-- <img src="images/main/visual01.jpg"> -->
          <div class="slide-text playText">
            <h1>한국 식품의 세계화</h1>
            <p>안전하고 우수한 한국식품이 세계인의 모든 식탁에 오를 때까지 정진해 나가겠습니다. </p>
          </div>
        </div>

        <div class="swiper-slide slide02" data-swiper-autoplay="5000">
          <!-- <img src="images/main/visual03.jpg"> -->
          <div class="slide-text playText">
            <h1>소중한 우리 아름다운 미래</h1>
            <p>함께하는 모든 분들의 행복한 미래를 추구하며, 사회적 기여를 꾸준히 실천하겠습니다.</p>
          </div>
        </div>
        <div class="swiper-slide slide03" data-swiper-autoplay="5000">
          <!-- <img src="images/main/visual02.jpg"> -->
          <div class="slide-text playText">
            <h1>건강한 미래를 위한 식품 연구 개발</h1>
            <p>건강하고 안전한 식품을 끊임없이 연구개발해 나가겠습니다. </p>
          </div>
        </div>

        <div class="swiper-slide slide04" data-swiper-autoplay="5000">
          <!-- <img src="images/main/visual04.jpg"> -->
          <div class="slide-text playText">
            <h1>정직과 신뢰</h1>
            <p>식품안전을 위해 정직과 고객을 위한 헌신은 호산의 영원한 약속입니다.</p>
          </div>
        </div>

      </div>
    </div>    
    <div class="swiper-pagination"></div>
     
    <!-- partial -->
    <div class="main-info-1">
        <div>
          <p>호산물산(주) 연혁</p>
          <button type="button">
            <a href="./sub/history.php">자세히보기</a>
          </button>
        </div>

        <div class="main_info2">
            <p>News & Notice</p>
            <button type="button">
            <a href="./sub/notice_list.php">자세히보기</a>
            </button>
         </div>
     </div>
        
  </article>
  <!-- E: CONTENTS -->
<!-- 메인화면 최신글 끝 -->

<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>