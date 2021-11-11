<?php
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

include_once('./pd_cate.php');

define("G5_PD_URL", "product");
define("G5_PD_DIR", "product");

if($w != '' && $w != 'u' && $w != 'r') {
    alert('올바른 방법으로 이용해 주십시오.');
}

if($is_guest)
    alert('회원이시라면 로그인 후 이용해 보십시오.', G5_URL.'/bbs/login.php?url='.urlencode(G5_URL.'/product/pd_list.php'));


//$g5['title'] = $qaconfig['pd_title'];
include_once('./pd_head.php');

$skin_file = $pd_skin_path.'/write.skin.php';

if(is_file($skin_file)) {
    /*==========================
    $w == a : 답변
    $w == r : 추가질문
    $w == u : 수정
    ==========================*/

    if($w == 'u' || $w == 'r') {
        $sql = " select * from ko_g5_product where pd_num = '$pd_num' ";
        $write = sql_fetch($sql);

        $sql = " select * from ko_g5_product_detail where pd_num = '$pd_num' order by pd_sub_num asc";
        $result = sql_query($sql);
        for($i=0; $row=sql_fetch_array($result); $i++) {
            $write_sub[$i+1] = $row;
        }

        // 분류
        $write['pd_cate'] = [$write['pd_cate1'],$write['pd_cate2'],$write['pd_cate3']];

        $write['pd_pos'] = [$write['pd_pos1'],$write['pd_pos2'],$write['pd_pos3']];

        if($w == 'u') {
            if(!$write['pd_num'])
                alert('상품이 존재하지 않습니다.\\n삭제되었거나 자신의 글이 아닌 경우입니다.');
        }
    }

    $is_dhtml_editor = false;
    if ($config['cf_editor'] && $qaconfig['pd_use_editor'] && (!is_mobile() || defined('G5_IS_MOBILE_DHTML_USE') && G5_IS_MOBILE_DHTML_USE)) {
        $is_dhtml_editor = true;
    }

    $summary = '';
    if ($w == '') {
    } else {
        // KISA 취약점 권고사항 Stored XSS
        $summary = get_text(html_purifier($write['pd_2']), 0);
    }

    $content = '';
    if ($w == '') {
    } else {
        // KISA 취약점 권고사항 Stored XSS
        $content = get_text(html_purifier($write['pd_4']), 0);
    }

    $summary_html = editor_html('pd_2', $summary, true);
    
    $summary_js = '';
    $summary_js .= get_editor_js('pd_2', true);
    $summary_js .= chk_editor_js_msg('pd_2',"요약을 입력하여 주십시오.");   

    $content_html = editor_html('pd_4', $content, true);

    $content_js = '';
    $content_js .= get_editor_js('pd_4', true);
    $content_js .= chk_editor_js_msg('pd_4', "설명을 입력하여 주십시오."); 

    $upload_max_filesize = number_format(100000) . ' 바이트';

    $html_value = '';
    if ($write['pd_html']) {
        $html_checked = 'checked';
        $html_value = $write['pd_html'];

        if($w == 'r' && $write['pd_html'] == 1 && !$is_dhtml_editor)
            $html_value = 2;
    }

    $is_email = false;
    $req_email = '';
    if($qaconfig['pd_use_email']) {
        $is_email = true;

        if($qaconfig['pd_req_email'])
            $req_email = 'required';

        if($w == '' || $w == 'r')
            $write['pd_email'] = $member['mb_email'];

        if($w == 'u' && $is_admin && $write['pd_type'])
            $is_email = false;
    }

    $is_hp = false;
    $req_hp = '';
    if($qaconfig['pd_use_hp']) {
        $is_hp = true;

        if($qaconfig['pd_req_hp'])
            $req_hp = 'required';

        if($w == '' || $w == 'r')
            $write['pd_hp'] = $member['mb_hp'];

        if($w == 'u' && $is_admin && $write['pd_type'])
            $is_hp = false;
    }

    $qstr = "?cate1=$cate1&cate2=$cate2&position=$position";
    $list_href = G5_URL.'/product/pd_list.php'.preg_replace('/^&amp;/', '?', $qstr);

    $action_url = https_url(G5_PD_DIR).'/pd_write_update.php';

    include_once($skin_file);
} else {
    echo '<div>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</div>';
}

include_once('./pd_tail.php');
?>