<?php
include_once('./_common.php');
include_once(G5_EDITOR_LIB);
include_once('./pd_cate.php');
include_once('./pd_head.php');

define("G5_PD_URL", G5_URL."/product");
define("G5_PD_DIR", G5_URL."/product");

$skin_file = $pd_skin_path.'/view.skin.php';

if(is_file($skin_file)) {
    $sql = " select * from ko_g5_product where pd_num = '$pd_num' ";
    $view = sql_fetch($sql);

    $sql = " select * from ko_g5_product_detail where pd_num = '$pd_num' order by pd_sub_num asc";
    $result = sql_query($sql);
    for($i=0; $row=sql_fetch_array($result); $i++) {
        $view_sub[$i+1] = $row;
    }

    if(!$view['pd_num'])
        alert('게시글이 존재하지 않습니다.\\n삭제되었거나 자신의 글이 아닌 경우입니다.');

    /*
    if (isset($_REQUEST['category'])) { // 리스트 페이지
        $category = $_REQUEST['category'];
        if($category)
            $qstr .= '&amp;category=' . urlencode($category);
    } else {
        $category = '';
    }

    if (isset($_REQUEST['position'])) { // 리스트 페이지
        $position = $_REQUEST['position'];
        if($position)
            $qstr .= '&amp;position=' . urlencode($position);
    } else {
        $position = '';
    }
    */
    $qstr = "&cate1=$cate1&cate2=$cate2&position=$position";

    // 이전글, 다음글
    $sql = " select pd_num, pd_subject
                from ko_g5_product
                where pd_type = '0' ";
    if(!$is_admin) {
        $sql .= " and mb_id = '{$member['mb_id']}' ";
    }

    // 이전글
    $prev_search = " and pd_num < '{$view['pd_num']}' order by pd_num desc limit 1 ";
    $prev = sql_fetch($sql.$prev_search);

    $prev_href = '';
    if (isset($prev['pd_num']) && $prev['pd_num']) {
        $prev_pd_subject = get_text(cut_str($prev['pd_subject'], 255));
        $prev_href = G5_PD_URL.'/pd_view.php?pd_num='.$prev['pd_num'].$qstr;
    }

    // 다음글
    $next_search = " and pd_num > '{$view['pd_num']}' order by pd_num asc limit 1 ";
    $next = sql_fetch($sql.$next_search);

    $next_href = '';
    if (isset($next['pd_num']) && $next['pd_num']) {
        $next_pd_subject = get_text(cut_str($next['pd_subject'], 255));
        $next_href = G5_PD_URL.'/pd_view.php?pd_num='.$next['pd_num'].$qstr;
    }

    $update_href = '';
    $delete_href = '';
    $write_href = G5_PD_URL.'/pd_write.php';
    $rewrite_href = G5_PD_URL.'/pd_write.php?w=r&amp;pd_num='.$view['pd_num'];
    $list_href = G5_PD_URL.'/pd_list.php'.preg_replace('/^&amp;/', '?', $qstr);

    if($is_admin) {
        $update_href = G5_PD_URL.'/pd_write.php?w=u&amp;pd_num='.$view['pd_num'].$qstr;
        set_session('ss_pd_delete_token', $token = uniqid(time()));
        $delete_href = G5_PD_URL.'/pd_delete.php?pd_num='.$view['pd_num'].'&amp;token='.$token.$qstr;
    }

    $stx = get_text(stripslashes($stx));

    $is_dhtml_editor = false;
    // 모바일에서는 DHTML 에디터 사용불가
    if ($config['cf_editor'] && $qaconfig['pd_use_editor'] && !G5_IS_MOBILE) {
        $is_dhtml_editor = true;
    }
    $editor_html = editor_html('pd_content', $content, $is_dhtml_editor);
    $editor_js = '';
    $editor_js .= get_editor_js('pd_content', $is_dhtml_editor);
    $editor_js .= chk_editor_js('pd_content', $is_dhtml_editor);

    $ss_name = 'ss_pd_view_'.$pd_num;
    if(!get_session($ss_name))
        set_session($ss_name, TRUE);

    include_once($skin_file);
} else {
    echo '<div>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</div>';
}

include_once('./pd_tail.php');
?>