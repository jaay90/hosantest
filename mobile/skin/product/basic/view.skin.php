<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
$pd_skin_url = G5_URL."/mobile/skin/product/basic";
add_stylesheet('<link rel="stylesheet" href="'.$pd_skin_url.'/style.css">', 0);
?>
<div id="wrapper" class="sub-page">
    <div class="container-flud sub-banner gray_bg">
    <h1>제품소개</h1>
    <p class="h1-desc">㈜네오메디제약의 제품을 소개합니다.</p>
   <!--  <div class="productitem_search">
                <input type="text" id="stx" name="stx" class="stx" />
                <buton type="button" class="btn_search"><i class="fa fa-search">
            </i></button>
            </div> -->
    </div>

<!--     <div class="container">
        <div class="col-12 mx-auto bread-wrapper" aria-label="breadcrumb">
          <ol class="breadcrumb1">
            <li class="breadcrumb-item"><a href="#"><img src="../_img/home.png"></a></li>
            <li class="breadcrumb-item"><a href="#">제품</a></li>
            <li class="breadcrumb-item active">반창고</li>
          </ol>
        </div>
    </div> -->
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<ul class="container btn_pd_con">
	<li><a href="<?php echo $list_href ?>" class="btn_pd">목록</a></li>
    <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" onclick="del(this.href); return false;" class="btn_pd">삭제</a></li><?php } ?>
	<?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_pd">수정</a></li><?php } ?>
</ul>
<script>
// 글쓰기 관리자 옵션
$(".btn_more_opt").on("click", function() {
    $(".more_opt").toggle();
})
</script>

<!-- 게시물 읽기 시작 { -->
    <div class="row productdt">
      <div class="productdt-left">
        <div class="dis">의약외품</div>
        <h1 class=""><?echo $view['pd_1']?></h1>
        <div class="border-bottom my-3"></div>
        <div>
            <?php
            $pd_tags = explode(",",$view['pd_3']);
            ?>
          <ul class="product_tag">
            <?
            foreach($pd_tags as $pd_tag){
              echo "<li>{$pd_tag}</li>";
            }
            ?>
          </ul>
        </div>
        <div class="productdt_text"><?echo $view['pd_2']?></div>
      </div>

      <div class="productdt-right">
        <?php $thumnail = "";$thumnail = G5_DATA_URL ."/product/". $view['pd_img1']; ?>
        <img class="card-img" src="<?php echo $thumnail; ?>"/>
      </div>

      <div id="productbt">
         <div class="row">
           <div class="productdt_bt">
             <div class="card-type">
                <?php $subimg = ""; $subimg = G5_DATA_URL ."/product/". $view['pd_file1']; ?>
                 <img src="<?php echo $subimg; ?>" class="img-fluid" alt="">
             </div>
           </div>
           <div class="productdt_bt">
             <div class="card-type">
                <?php $subimg = ""; $subimg = G5_DATA_URL ."/product/". $view['pd_file2']; ?>
                 <img src="<?php echo $subimg; ?>" class="img-fluid" alt="">
             </div>
           </div>
           <div class="productdt_bt">
             <div class="card-type">
                <?php $subimg = ""; $subimg = G5_DATA_URL ."/product/". $view['pd_file3']; ?>
                 <img src="<?php echo $subimg; ?>" class="img-fluid" alt="">
             </div>
           </div>
           <div class="productdt_bt">
             <div class="card-type">
                <?php $subimg = ""; $subimg = G5_DATA_URL ."/product/". $view['pd_file4']; ?>
                 <img src="<?php echo $subimg; ?>" class="img-fluid" alt="">
             </div>
           </div>
         </div>
         <div class="row">
           <div class="productdt_bt">
             <div class="card-type">
                <?php $subimg = ""; $subimg = G5_DATA_URL ."/product/". $view['pd_file5']; ?>
                 <img src="<?php echo $subimg; ?>" class="img-fluid" alt="">
             </div>
           </div>
           <div class="productdt_bt">
             <div class="card-type">
                <?php $subimg = ""; $subimg = G5_DATA_URL ."/product/". $view['pd_file6']; ?>
                 <img src="<?php echo $subimg; ?>" class="img-fluid" alt="">
             </div>
           </div>
           <div class="productdt_bt">
             <div class="card-type">
                <?php $subimg = ""; $subimg = G5_DATA_URL ."/product/". $view['pd_file7']; ?>
                 <img src="<?php echo $subimg; ?>" class="img-fluid" alt="">
             </div>
           </div>
           <div class="productdt_bt">
             <div class="card-type">
                <?php $subimg = ""; $subimg = G5_DATA_URL ."/product/". $view['pd_file8']; ?>
                 <img src="<?php echo $subimg; ?>" class="img-fluid" alt="">
             </div>
           </div>
         </div>
      </div>
      <div class="productdt_text"><?echo $view['pd_4']?></div>
        <?if($view_sub){?>
        <div class="productdt_slider">
        <?foreach($view_sub as $view_item){?>
            <div class="productdt_slider_item">
                <div class="productdt_slider_box">
                <?php $subimg = ""; $subimg = G5_DATA_URL ."/product/". $view_item['pd_sub_file1']; ?>
                <img src="<?php echo $subimg; ?>" />
                <span><?echo $view_item['pd_sub_text']?></span>
                </div>
            </div>
        <?}?>
        </div>
        <?}?>
    </div>
</div>
<!-- } 게시판 읽기 끝 -->

<script>
    if (window.matchMedia("(min-width: 1200px)").matches) {
        $(document).ready(function(){
            var bdr = $('.productdt_slider').show().bxSlider({
                speed:800,
                slideWidth:1200,
                minSlides: 3,
                maxSlides: 3,
                moveSlides:1,
                auto: true,
                pager:false,
                useCSS : false,
                onSlideAfter : function(){
                    bdr.startAuto();
                }
            });
        });
    }else{
        $(document).ready(function(){
            var bdr = $('.productdt_slider').show().bxSlider({
                speed:800,
                minSlides: 1,
                maxSlides: 1,
                moveSlides:1,
                auto: true,
                pager:false,
                useCSS : false,
                onSlideAfter : function(){
                    bdr.startAuto();
                }
            });
});
    }

</script>