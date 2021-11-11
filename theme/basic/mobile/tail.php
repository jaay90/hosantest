<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
	<footer id="footer">		
		<div class="fWrap">
			<div class="snsbtwrap">
				<span class="footer-sns">
					<a href="https://www.instagram.com/hosan_co" target='_blank'>INSTAGRAM</a>
				</span>	
			</div>
							
			<div class="footer">
				<div class="fnb">
					<a href="<?echo G5_URL?>/sub/privacy.php">개인정보보호방침</a>
				</div>					
				<div class="copyright">
					호산물산(주) &emsp;대표 : 이필성 &emsp;문의 : hosan@koreanproducts.net					
				</div>
				<div class="copyright">
					서울특별시 강남구 테헤란로 78길 14-14 제나빌딩 7층 &emsp;전화 : 02-564-9941~2 &emsp;팩스 : 02-564-9943
					<p>&ensp;본사 : 경기도 이천시 호법면 이섭대천로 263번길 57 &emsp;&ensp;전화 : 031-631-9941~2 &emsp;팩스 : 031-631-9943</p>					
				</div>
				<div class="copyright">
					<span class="textbold">Copyright 2021. Hosan Trading Co.,Ltd.</span> all rights reserved.
				</div>									
			</div>			
		</div>
	</footer>
<script>
jQuery(function($) {

    $( document ).ready( function() {

        // 폰트 리사이즈 쿠키있으면 실행
        font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
        
        //상단고정
        if( $(".top").length ){
            var jbOffset = $(".top").offset();
            $( window ).scroll( function() {
                if ( $( document ).scrollTop() > jbOffset.top ) {
                    $( '.top' ).addClass( 'fixed' );
                }
                else {
                    $( '.top' ).removeClass( 'fixed' );
                }
            });
        }

        //상단으로
        $("#top_btn").on("click", function() {
            $("html, body").animate({scrollTop:0}, '500');
            return false;
        });

    });
});
</script>
<script type="text/javascript">		
  $(document).ready(function () {
    var mySwiper = new Swiper ('.swiper-container', {
      loop:true,
      autoplay:{
        delay:5000,
        disableOnInteraction:false,
      },

      nextButton: '.swiper-button-next',
      prevButton: '.swiper-button-prev',

      direction: 'horizontal',
      pagination: '.swiper-pagination',
      paginationClickable: true,
      paginationBulletRender: function (swiper, index, className) {
          return '<span class="' + className + '">' + '0' + (index + 1) + '</span>';
      }
    })

  });
	</script>
	<script  src="<?echo G5_URL?>/js/gnb.js"></script>
<?php
include_once(G5_THEME_PATH."/tail.sub.php");