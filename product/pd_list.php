<?php
include_once('./_common.php');

// if($is_guest)
//     alert('회원이시라면 로그인 후 이용해 보십시오.', './login.php?url='.urlencode(G5_PDT_URL.'/qalist.php'));

include_once('./pd_head.php');
$pd_skin_path = G5_PATH."/mobile/skin/product/basic";
$skin_file = $pd_skin_path.'/list.skin.php';

$g5['pd_content_table'] = "ko_g5_product";

include_once('./pd_cate.php');

if(is_file($skin_file)) {
    $sql_common = " from {$g5['pd_content_table']} ";
    $sql_search = " where 1 = 1 ";

    /*
    if(is_array($category)){
        $sql_category = join("','",$category);
        $sql_search .= "and";
        $sql_search .= " (pd_cate1 in('".$sql_category."')";
        $sql_search .= " or pd_cate2 in('".$sql_category."')";
        $sql_search .= " or pd_cate3 in('".$sql_category."'))";

        $cateparam = join(",",$category);
    }else if($category != ""){
        $category = explode(",",$category);

        $sql_category = join("','",$category);
        $sql_search .= "and";
        $sql_search .= " (pd_cate1 in('".$sql_category."')";
        $sql_search .= " or pd_cate2 in('".$sql_category."')";
        $sql_search .= " or pd_cate3 in('".$sql_category."'))";

        $cateparam = join(",",$category);        
    }
    */
    if($cate1 != ""){
        $sql_search .= "and pd_cate1 = '$cate1'";
    }

    if($cate2 != ""){
        $sql_search .= "and pd_cate2 = '$cate2'";
    }

    if($cate2 == "" && $position != ""){
        $sql_search .= "and pd_pos1 = '$position'";
    }else{
        $position = "";
    }
    // if($sca) {
    //     if (preg_match("/[a-zA-Z]/", $sca))
    //         $sql_search .= " and INSTR(LOWER(pd_category), LOWER('$sca')) > 0 ";
    //     else
    //         $sql_search .= " and INSTR(pd_category, '$sca') > 0 ";
    // }

    $stx = trim($stx);
    $stx2 = trim($stx2);
    if($stx2) {
        $stx = $stx2;
    }
    
    if($stx) {
        if (preg_match("/[a-zA-Z]/", $stx))
            $sql_search .= " and ( INSTR(LOWER(pd_1), LOWER('$stx')) > 0 or INSTR(LOWER(pd_2), LOWER('$stx')) > 0 )";
        else
            $sql_search .= " and ( INSTR(pd_1, '$stx') > 0 or INSTR(pd_2, '$stx') > 0 ) ";
    }


    $sql_order = " order by pd_num desc";

    $sql = " select count(*) as cnt
                $sql_common
                $sql_search ";
    $row = sql_fetch($sql);
    $total_count = $row['cnt'];

    $page_rows = 8;
    $page_count = 1;
    $total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
    if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
    $from_record = ($page - 1) * $page_rows; // 시작 열을 구함

    $sql = " select *
                $sql_common
                $sql_search
                $sql_order
                limit $from_record, $page_rows ";
    $result = sql_query($sql);

    //echo $sql;

    $list = array();
    $num = $total_count - ($page - 1) * $page_rows;

    $qstr = "&cate1=$cate1&cate2=$cate2&position=$position";

    for($i=0; $row=sql_fetch_array($result); $i++) {
        $list[$i] = $row;

        //$list[$i]['pd_cate1'] = get_text($row['pd_cate1']);
        //$list[$i]['pd_1'] = conv_subject($row['pd_1'], $subject_len, '…');
        
        if ($stx) {
            $list[$i]['subject'] = search_font($stx, $list[$i]['subject']);
        }

        //$list[$i]['view_href'] = 'pd_view.php?pd_num='.$row['pd_num'].$qstr;
        $list[$i]['view_href'] = 'pd_write.php?w=u&pd_num='.$row['pd_num'].$qstr;

        $list[$i]['icon_file'] = '';
        if(trim($row['pd_file1']) || trim($row['pd_file2']))
            $list[$i]['icon_file'] = '<img src="'.$pd_skin_url.'/img/icon_file.gif">';

        $list[$i]['name'] = get_text($row['pd_2']);
        // 사이드뷰 적용시
        //$list[$i]['name'] = get_sideview($row['mb_id'], $row['pd_name']);
        $list[$i]['date'] = substr($row['pd_regdate'], 2, 8);

        $list[$i]['num'] = $num - $i;
    }

    $qstr = "?cate1=$cate1&cate2=$cate2&position=$position";

    $is_checkbox = false;
    $admin_href = '';
    if($is_admin) {
        $is_checkbox = true;
        $admin_href = G5_ADMIN_URL.'/pd_config.php';
    }

    $list_href = 'pd_list.php';
    $write_href = 'pd_write.php'.$qstr;

    $list_pages = preg_replace('/(\.php)(&amp;|&)/i', '$1?', get_paging($page_count, $page, $total_page, './pd_list.php'.$qstr.'&amp;page='));
    //$list_pages = preg_replace('/(\.php)(&amp;|&)/i', '$1?', get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './qalist.php'.$qstr.'&amp;page='));

    $stx = get_text(stripslashes($stx));
    include_once($skin_file);
} else {
    echo '<div>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</div>';
}

include_once('./pd_tail.php');
?>