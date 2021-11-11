<?php
include_once('./_common.php');

if($is_guest)
    alert('회원이시라면 로그인 후 이용해 주십시오.', G5_URL);

$delete_token = get_session('ss_pd_delete_token');
set_session('ss_pd_delete_token', '');

//관리자가 아닌경우에는 토큰을 검사합니다.
if (!$is_admin && !($token && $delete_token == $token))
    alert('토큰 에러로 삭제 불가합니다.');

$g5['pd_content_table'] = "ko_g5_product";
$g5['pd_sub_table'] = "ko_g5_product_detail";

$tmp_array = array();
if ($pd_num) // 건별삭제
    $tmp_array[0] = $pd_num;
else // 일괄삭제
    $tmp_array = $_POST['chk_pd_num'];

$count = count($tmp_array);
if(!$count)
    alert('삭제할 게시글을 하나이상 선택해 주십시오.');

for($i=0; $i<$count; $i++) {
    $pd_num = (int) $tmp_array[$i];

    $sql = " select *
                from {$g5['pd_content_table']}
                where pd_num = '$pd_num' ";
    $row = sql_fetch($sql);

    if(!$row['pd_num'])
        continue;

    // 자신의 글이 아니면 건너뜀
    if($is_admin != 'super' && $row['mb_id'] !== $member['mb_id'])
        continue;

    for($k=1; $k<=5; $k++) {
        @unlink(G5_DATA_PATH.'/product/'.$row['pd_img'.$k]);
        // 썸네일삭제
        if(preg_match("/\.({$config['cf_image_extension']})$/i", $row['pd_img'.$k])) {
            delete_pd_thumbnail($row['pd_img'.$k]);
        }
    }

    // 첨부파일 삭제
    for($k=1; $k<=10; $k++) {
        @unlink(G5_DATA_PATH.'/product/'.$row['pd_file'.$k]);
        // 썸네일삭제
        if(preg_match("/\.({$config['cf_image_extension']})$/i", $row['pd_file'.$k])) {
            delete_pd_thumbnail($row['pd_file'.$k]);
        }
    }

    $sql = " select * from g5_product_detail where pd_num = '$pd_num' ";
    $result = sql_query($sql);
    for($i=0; $sub=sql_fetch_array($result); $i++) {
        $write_sub[$i+1] = $sub;
    }

    // 서브파일 삭제
    for($k=1; $k<=10; $k++) {
        @unlink(G5_DATA_PATH.'/product/'.$write_sub[$k]['pd_sub_file1']);
        // 썸네일삭제
        if(preg_match("/\.({$config['cf_image_extension']})$/i", $write_sub[$k]['pd_sub_file1'])) {
            delete_pd_thumbnail($write_sub[$k]['pd_sub_file1']);
        }
    }

    // 에디터 썸네일 삭제
    //delete_editor_thumbnail($row['pd_content']);

    // 글삭제
    sql_query(" delete from {$g5['pd_content_table']} where pd_num = '$pd_num' ");
    sql_query(" delete from {$g5['pd_sub_table']} where pd_num = '$pd_num' ");
}
//exit;
$qstr = "cate1=$cate1&cate2=$cate2&position=$position";
goto_url(G5_URL.'/product/pd_list.php'.preg_replace('/^&amp;/', '?', $qstr));

// 게시판 첨부파일 썸네일 삭제
function delete_pd_thumbnail($file)
{
    if(!$bo_table || !$file)
        return;

    $fn = preg_replace("/\.[^\.]+$/i", "", basename($file));
    $files = glob(G5_DATA_PATH.'/product/'.'/thumb-'.$fn.'*');
    if (is_array($files)) {
        foreach ($files as $filename)
            unlink($filename);
    }
}
?>