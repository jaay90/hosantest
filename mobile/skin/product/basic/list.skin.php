<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
$pd_skin_url = G5_URL."/mobile/skin/product/basic";
add_stylesheet('<link rel="stylesheet" href="'.$pd_skin_url.'/style.css">', 0);
?>
<div class="pageNavi">
			<h2 class="blind">현재 페이지 위치 안내</h2>
			<span class="home_ic"></span>
			<span>제품</span>
			A+ Hosan
		</div>
		<section class="contents2 pdcontents2">
			<ul class="pageLink2">
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&position=on'?>" class="<?echo $cate1==1?'on':''?>">A+ Hosan</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=2&cate2=과자'?>" class="<?echo $cate1==2?'on':''?>">National Brand</a></li>
			</ul>
		</section>
        <?if($cate1 == 1){?>
		<section class="contents2 pdcontents2">
			<ul class="controls pageLink3">
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&position=on'?>" class="control<?echo $position=='on'?' on':''?>" data-filter=".new" >신제품</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=음료류'?>" class="control<?echo $cate2=='음료류'?' on':''?>" data-filter=".drink">음료류</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=김류'?>" class="control<?echo $cate2=='김류'?' on':''?>" data-filter=".seaweed">김류</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=국수류'?>" class="control<?echo $cate2=='국수류'?' on':''?>" data-filter=".noodle">국수류</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=우동류'?>" class="control<?echo $cate2=='우동류'?' on':''?>" data-filter=".udon">우동류</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=차류'?>" class="control<?echo $cate2=='차류'?' on':''?>" data-filter=".tea">차류</a></li>
				<li class="longtab"><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=냉동가공식품류'?>" class="control<?echo $cate2=='냉동가공식품류'?' on':''?>" data-filter=".frozen">냉동가공식품류</a></li>
				<li class="longtab"><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=냉동수산물'?>" class="control<?echo $cate2=='냉동수산물'?' on':''?>" data-filter=".frozen-fish">냉동수산물</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=김치'?>" class="control<?echo $cate2=='김치'?' on':''?>" data-filter=".Kimchi">김치</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=기타'?>" class="control<?echo $cate2=='기타'?' on':''?>" data-filter=".etc">기타</a></li>
			</ul>
		</section>
		<div class="Mcontainer1">
		  <ul>
		    <li class="dropdown">
		      <input type="checkbox" />
		      <a href="product01.html" data-toggle="dropdown">A+ Hosan</a>
		      <ul class="dropdown-menu">
		        <li><a href="product02.html">National Brand</a></li>
		      </ul>
		    </li>
		  </ul>
		  <section class="contents2 Mcontent1">
		      <ul class="controls pageLink3">
              <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&position=on'?>" class="control<?echo $position=='on'?' on':''?>" data-filter=".new" >신제품</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=음료류'?>" class="control<?echo $cate2=='음료류'?' on':''?>" data-filter=".drink">음료류</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=김류'?>" class="control<?echo $cate2=='김류'?' on':''?>" data-filter=".seaweed">김류</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=국수류'?>" class="control<?echo $cate2=='국수류'?' on':''?>" data-filter=".noodle">국수류</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=우동류'?>" class="control<?echo $cate2=='우동류'?' on':''?>" data-filter=".udon">우동류</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=차류'?>" class="control<?echo $cate2=='차류'?' on':''?>" data-filter=".tea">차류</a></li>
				<li class="longtab"><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=냉동가공식품류'?>" class="control<?echo $cate2=='냉동가공식품류'?' on':''?>" data-filter=".frozen">냉동가공식품류</a></li>
				<li class="longtab"><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=냉동수산물'?>" class="control<?echo $cate2=='냉동수산물'?' on':''?>" data-filter=".frozen-fish">냉동수산물</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=김치'?>" class="control<?echo $cate2=='김치'?' on':''?>" data-filter=".Kimchi">김치</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=1&cate2=기타'?>" class="control<?echo $cate2=='기타'?' on':''?>" data-filter=".etc">기타</a></li>
		      </ul>
		  </section>
		</div>
        <?}else{?>
        <section class="contents2 pdcontents2">
			<ul class="controls pageLink3 pageLink4">
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=2&cate2=과자'?>" class="control<?echo $cate2=='과자'?' on':''?>" data-filter=".new" >과자</a></li>
				<li class="longtab"><a href="<?echo G5_URL.'/product/pd_list.php?cate1=2&cate2=인스턴트 라면(팩/컵/봉지)'?>" class="control<?echo $cate2=='인스턴트 라면(팩/컵/봉지)'?' on':''?>" data-filter=".drink">인스턴트 라면(팩/컵/봉지)</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=2&cate2=소스'?>" class="control<?echo $cate2=='소스'?' on':''?>" data-filter=".seaweed">소스</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=2&cate2=기타'?>" class="control<?echo $cate2=='기타'?' on':''?>" data-filter=".etc">기타</a></li>
			</ul>
		</section>
		<div class="Mcontainer1">
		  <ul>
		    <li class="dropdown">
		      <input type="checkbox" />
		      <a href="product01.html" data-toggle="dropdown">A+ Hosan</a>
		      <ul class="dropdown-menu">
		        <li><a href="product02.html">National Brand</a></li>
		      </ul>
		    </li>
		  </ul>
		  <section class="contents2 Mcontent1 Mcontent2">
		      <ul class="controls pageLink3">
              <li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=2&cate2=과자'?>" class="control<?echo $cate2=='과자'?' on':''?>" data-filter=".new" >과자</a></li>
				<li class="longtab"><a href="<?echo G5_URL.'/product/pd_list.php?cate1=2&cate2=인스턴트 라면(팩/컵/봉지)'?>" class="control<?echo $cate2=='인스턴트 라면(팩/컵/봉지)'?' on':''?>" data-filter=".drink">인스턴트 라면(팩/컵/봉지)</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=2&cate2=소스'?>" class="control<?echo $cate2=='소스'?' on':''?>" data-filter=".seaweed">소스</a></li>
				<li><a href="<?echo G5_URL.'/product/pd_list.php?cate1=2&cate2=기타'?>" class="control<?echo $cate2=='기타'?' on':''?>" data-filter=".etc">기타</a></li>
			</ul>
		  </section>
		</div>
        <?}?>
    <form name="pdlist" id="pdlist" action="./pd_delete.php" onsubmit="return pd_search();" method="post">
        <!--input type="hidden" name="stx" value="<?php echo $stx; ?>"-->
        <!--input type="hidden" name="sca" value="<?php echo $sca; ?>"-->
        <input type="hidden" name="page" value="<?php echo $page; ?>">
            <div class="container product-list">
                <div class="pdalltext">
                    <?php if ($admin_href || $write_href) { ?>
                        <?php if ($is_admin == 'super' || $is_auth) {  ?>
                            <?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="btn_pd">상품등록</a><?php } ?>
                            <button type="button" name="btn_submit" value="선택삭제" class="btn_pd" onclick="pdlist_submit()">선택삭제</button>
                            <script>
                                // 게시판 리스트 관리자 옵션
                                $(".btn_more_opt").on("click", function() {
                                    $(".more_opt").toggle();
                                })
                            </script>
                        <?php } ?>
                    <?php } ?>
                </div>                  
				<div class="pdalltext">총 <span class="textbold textred"><?echo $total_count?>개</span>의 제품이 있습니다.</div>   
				<div id="product_box" class="flex">
                    <?php
                    for ($i=0; $i<count($list); $i++) {
                    ?>                    
					<div class="product-wrap mix drink">
                        <?php if ($is_checkbox) { ?>
                            <input type="checkbox" name="chk_pd_num[]" value="<?php echo $list[$i]['pd_num'] ?>" id="chk_pd_num_<?php echo $i ?>" class="">
                            <?php } ?>                        
                        <?if($list[$i]['pd_pos1'] === 'on'){?>
						<span class="newmark">신제품</span>
                        <?}?>
						<div class="img-wrap">
                            <?php 
                            $thumnail = "";$thumnail = G5_DATA_URL ."/product/". $list[$i]['pd_img1']; 
                            $mainimage = "";$mainimage = G5_DATA_URL ."/product/". $list[$i]['pd_file1']; 
                            ?>
                            <img src="<?php echo $thumnail; ?>">
						</div>
						<div class="product-item" onclick="product_pop('popup<?echo $i?>')">
							<h2 class="item-title"><?echo $list[$i]['pd_1']?></h2>
							<div class="item-sort">
								<span><?echo $list[$i]['pd_3']?></span>
							</div>
						</div>
                        <?php if ($is_checkbox) { ?>
                            <a href="<?php echo $list[$i]['view_href']; ?>">수정</a>
                        <?}?>
                        <div id="popup<?echo $i?>" class="popup">
                            <a href="javascript:" class="close" onclick="product_close('popup<?echo $i?>')">&times;</a>
                            <div class="img-wrap">
                                <img src="<?php echo $mainimage; ?>">
                            </div>
                            <h2 class="item-title"><?echo $list[$i]['pd_1']?></h2>
                            <div class="item-sort">
                                <p><?echo $list[$i]['pd_3']?></p>
                            </div>
                        </div>
                        <a href="#" id="close_popup<?echo $i?>" class="close-popup"></a>                             
					</div>               
                    <?php
                    }
                    ?>
                    <?php if ($i == 0) { echo '상품이 없습니다.'; } ?>					
				</div>
                <?if($page_rows < $total_count){?>
				<button type="button" id="btn_more" class="more_bt">더보기</button>
                <?}?>
			</div>
    </form>

<style>
    .popup, .close-popup {display:none}
</style>
<script>
//더보기
sessionStorage.setItem("cpage",1);
$('#btn_more').click(function(){
    var cate1 = <?echo $cate1==''?'""':"'$cate1'"?>;
    var cate2 = <?echo $cate2==''?'""':"'$cate2'"?>;
    var position = <?echo $position==''?'""':"'$position'"?>;
    //더보기페이지 설정
    var totalcount = <?echo $total_count>0?$total_count:0 ?>;
    var pagerows = <?echo $page_rows>0?$page_rows:0 ?>;
    var cpage = sessionStorage.getItem("cpage");
    cpage++;
    sessionStorage.setItem("cpage",cpage);

    $.get('<?echo G5_URL."/product/pd_list_ajax.php"?>',
        { cate1: cate1, cate2: cate2, position: position, page: cpage },
        // 서버가 필요한 정보를 같이 보냄. 
        function(data, status){
            //전송받은 데이터와 전송 성공 여부를 보여줌.
            $("#product_box").append(data);
            //더보기 확인
            if(pagerows*cpage>=totalcount){
                $('#btn_more').hide();
            }
        }
    );
});

function product_pop(pid){
    $('#'+pid).show();
    $('#close_'+pid).show();
}

function product_close(pid){
    $('#'+pid).hide();
    $('#close_'+pid).hide();
}
</script>
<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.pdlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_pd_num[]")
            f.elements[i].checked = sw;
    }
}
function pdlist_submit() {
    var f = document.pdlist;
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_pd_num[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert("선택삭제 할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다")){
        return false;
    }

    f.action = "./pd_delete.php";
    f.submit();
}
</script>
<?php } ?>

<script>
$('.btn_search').click(pd_search);
//$('.product_cate input:checkbox').change(pd_search2);
//$('.product_pos input:checkbox').change(pd_search2);

function pd_search(){
    var f = document.pdlist;
    f.action = "./pd_list.php";
    if(f.stx.value == ""){
        alert("검색어를 입력 하십시오.");
        f.stx.focus();
        return false;
    }
    f.page.value = "";
    f.submit();
}

function pd_search2(){
    var f = document.pdlist;
    f.action = "./pd_list.php";

    f.submit();
}

//라벨클릭시 펼치고 접기
$('.product_cate li label').click(function(){
    var _cate = this;
    $(_cate).next().slideToggle();
});


//필터클릭시 펼치고 접기
$('.mobilefilter').click(function(){
    $('.pd-filter').slideToggle();
});

</script>
<!-- } 게시판 목록 끝 -->