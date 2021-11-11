<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
$pd_skin_url = G5_URL."/mobile/skin/product/basic";
?>
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
        <?php $thumnail = "";$thumnail = G5_DATA_URL ."/product/". $list[$i]['pd_img1']; ?>
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
            <img src="<?php echo $thumnail; ?>">
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
