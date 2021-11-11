<?php
include_once('./_common.php');
define("G5_PD_URL", "/product");
define("G5_PD_DIR", "/product");

$g5['pd_content_table'] = "ko_g5_product";
$g5['pd_sub_table'] = "ko_g5_product_detail";
/*==========================
$w == a : 답변
$w == r : 추가질문
$w == u : 수정
==========================*/

// if($is_guest)
//     alert('회원이시라면 로그인 후 이용해 보십시오.', './login.php?url='.urlencode(G5_PD_URL.'/pdlist.php'));

// $msg = array();

// 1:1문의 설정값
// $qaconfig = get_pd_config();
// $pd_num = isset($pd_num) ? (int) $pd_num : 0;

// if(trim($qaconfig['pd_category'])) {
//     if($w != 'a') {
//         $category = explode('|', $qaconfig['pd_category']);
//         if(!in_array($pd_category, $category))
//             alert('분류를 올바르게 지정해 주십시오.');
//     }
// } else {
//     alert('1:1문의 설정에서 분류를 설정해 주십시오');
// }
/*
$pd_subject = '';
if (isset($_POST['pd_subject'])) {
    $pd_subject = substr(trim($_POST['pd_subject']),0,255);
    $pd_subject = preg_replace("#[\\\]+$#", "", $pd_subject);
}
if ($pd_subject == '') {
    $msg[] = '<strong>제목</strong>을 입력하세요.';
}

$pd_content = '';
if (isset($_POST['pd_content'])) {
    $pd_content = substr(trim($_POST['pd_content']),0,65536);
    $pd_content = preg_replace("#[\\\]+$#", "", $pd_content);
}
if ($pd_content == '') {
    $msg[] = '<strong>내용</strong>을 입력하세요.';
}

if (!empty($msg)) {
    $msg = implode('<br>', $msg);
    alert($msg);
}

if (substr_count($pd_content, '&#') > 50) {
    alert('내용에 올바르지 않은 코드가 다수 포함되어 있습니다.');
    exit;
}
*/

$upload_max_filesize = ini_get('upload_max_filesize');

if (empty($_POST)) {
    alert("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=".$upload_max_filesize."\\n게시판관리자 또는 서버관리자에게 문의 바랍니다.");
}

for ($i=1; $i<=5; $i++) {
    $var = "pd_$i";
    $$var = "";
    if (isset($_POST['pd_'.$i]) && $_POST['pd_'.$i]) {
        $$var = trim($_POST['pd_'.$i]);
    }
}

if($w == 'u' || $w == 'a' || $w == 'r') {
    if(!$is_admin)
        alert('답변은 관리자만 등록할 수 있습니다.');

    $sql = " select * from {$g5['pd_content_table']} where pd_num = '$pd_num' ";
    $write = sql_fetch($sql);

    $sql = " select * from g5_product_detail where pd_num = '$pd_num' ";
    $result = sql_query($sql);
    for($i=0; $row=sql_fetch_array($result); $i++) {
        $write_sub[$i+1] = $row;
    }    

    if($w == 'u') {
        if(!$write['pd_num'])
            alert('게시글이 존재하지 않습니다.\\n삭제되었거나 자신의 글이 아닌 경우입니다.');
    }
}

// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
@mkdir(G5_DATA_PATH.'/product', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/product', G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

// 썸네일 파일 업로드
$file_upload_msg = '';
$iupload = array();
for ($i=1; $i<=count($_FILES['pd_img']['name']); $i++) {
    $iupload[$i]['file']     = '';
    $iupload[$i]['source']   = '';
    $iupload[$i]['del_check'] = false;

    // 삭제에 체크가 되어있다면 파일을 삭제합니다.
    if (isset($_POST['pd_img_del'][$i]) && $_POST['pd_img_del'][$i]) {
        $iupload[$i]['del_check'] = true;
        @unlink(G5_DATA_PATH.'/product/'.$write['pd_img'.$i]);
        // 썸네일삭제
        if(preg_match("/\.({$config['cf_image_extension']})$/i", $write['pd_img'.$i])) {
            delete_pd_thumbnail($write['pd_img'.$i]);
        }
    }

    $tmp_file  = $_FILES['pd_img']['tmp_name'][$i];
    $filesize  = $_FILES['pd_img']['size'][$i];
    $filename  = $_FILES['pd_img']['name'][$i];
    $filename  = get_safe_filename($filename);

    // 서버에 설정된 값보다 큰파일을 업로드 한다면
    if ($filename) {
        if ($_FILES['pd_img']['error'][$i] == 1) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
            continue;
        }
        else if ($_FILES['pd_img']['error'][$i] != 0) {
            $file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
            continue;
        }
    }

    if (is_uploaded_file($tmp_file)) {
        // 관리자가 아니면서 설정한 업로드 사이즈보다 크다면 건너뜀
        if (!$is_admin && $filesize > $qaconfig['pd_upload_size']) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량('.number_format($filesize).' 바이트)이 게시판에 설정('.number_format($qaconfig['pd_upload_size']).' 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n';
            continue;
        }

        //=================================================================\
        // 090714
        // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
        // 에러메세지는 출력하지 않는다.
        //-----------------------------------------------------------------
        $timg = @getimagesize($tmp_file);
        // image type
        if ( preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
             preg_match("/\.({$config['cf_flash_extension']})$/i", $filename) ) {
            if ($timg['2'] < 1 || $timg['2'] > 16)
                continue;
        }

        //=================================================================
        if ($w == 'u') {
            // 존재하는 파일이 있다면 삭제합니다.
            @unlink(G5_DATA_PATH.'/product/'.$write['pd_img'.$i]);
            // 이미지파일이면 썸네일삭제
            if(preg_match("/\.({$config['cf_image_extension']})$/i", $write['pd_img'.$i])) {
                delete_pd_thumbnail($row['pd_img'.$i]);
            }
        }

        // 프로그램 원래 파일명
        $iupload[$i]['source'] = $filename;
        $iupload[$i]['filesize'] = $filesize;

        // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
        $filename = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

        shuffle($chars_array);
        $shuffle = implode('', $chars_array);

        // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
        $iupload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

        $dest_file = G5_DATA_PATH.'/product/'.$iupload[$i]['file'];

        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['pd_img']['error'][$i]);

        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);
    }
}

// 내용 파일 업로드
$file_upload_msg = '';
$upload = array();
for ($i=1; $i<=count($_FILES['pd_file']['name']); $i++) {
    $upload[$i]['file']     = '';
    $upload[$i]['source']   = '';
    $upload[$i]['del_check'] = false;

    // 삭제에 체크가 되어있다면 파일을 삭제합니다.
    if (isset($_POST['pd_file_del'][$i]) && $_POST['pd_file_del'][$i]) {
        $upload[$i]['del_check'] = true;
        @unlink(G5_DATA_PATH.'/product/'.$write['pd_file'.$i]);
        // 썸네일삭제
        if(preg_match("/\.({$config['cf_image_extension']})$/i", $write['pd_file'.$i])) {
            delete_pd_thumbnail($write['pd_file'.$i]);
        }
    }

    $tmp_file  = $_FILES['pd_file']['tmp_name'][$i];
    $filesize  = $_FILES['pd_file']['size'][$i];
    $filename  = $_FILES['pd_file']['name'][$i];
    $filename  = get_safe_filename($filename);

    // 서버에 설정된 값보다 큰파일을 업로드 한다면
    if ($filename) {
        if ($_FILES['pd_file']['error'][$i] == 1) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
            continue;
        }
        else if ($_FILES['pd_file']['error'][$i] != 0) {
            $file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
            continue;
        }
    }

    if (is_uploaded_file($tmp_file)) {
        // 관리자가 아니면서 설정한 업로드 사이즈보다 크다면 건너뜀
        if (!$is_admin && $filesize > $qaconfig['pd_upload_size']) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량('.number_format($filesize).' 바이트)이 게시판에 설정('.number_format($qaconfig['pd_upload_size']).' 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n';
            continue;
        }

        //=================================================================\
        // 090714
        // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
        // 에러메세지는 출력하지 않는다.
        //-----------------------------------------------------------------
        $timg = @getimagesize($tmp_file);
        // image type
        if ( preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
             preg_match("/\.({$config['cf_flash_extension']})$/i", $filename) ) {
            if ($timg['2'] < 1 || $timg['2'] > 16)
                continue;
        }

        //=================================================================
        if ($w == 'u') {
            // 존재하는 파일이 있다면 삭제합니다.
            @unlink(G5_DATA_PATH.'/product/'.$write['pd_file'.$i]);
            // 이미지파일이면 썸네일삭제
            if(preg_match("/\.({$config['cf_image_extension']})$/i", $write['pd_file'.$i])) {
                delete_pd_thumbnail($row['pd_file'.$i]);
            }
        }        

        // 프로그램 원래 파일명
        $upload[$i]['source'] = $filename;
        $upload[$i]['filesize'] = $filesize;

        // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
        $filename = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

        shuffle($chars_array);
        $shuffle = implode('', $chars_array);

        // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
        $upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

        $dest_file = G5_DATA_PATH.'/product/'.$upload[$i]['file'];

        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['pd_file']['error'][$i]);

        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);
    }
}

// 서브 파일 업로드
/*
$file_upload_msg = '';
$supload = array();
for ($i=1; $i<=count($_FILES['pd_sub_file']['name']); $i++) {
    $supload[$i]['num']     = $pd_sub_num[$i];
    $supload[$i]['text']     = $pd_sub_text[$i];
    $supload[$i]['file']     = '';
    $supload[$i]['source']   = '';
    $supload[$i]['del_check'] = false;

    // 삭제에 체크가 되어있다면 파일을 삭제합니다.
    if (isset($_POST['pd_sub_file_del'][$i]) && $_POST['pd_sub_file_del'][$i]) {
        $supload[$i]['del_check'] = true;
        @unlink(G5_DATA_PATH.'/product/'.$write_sub[$i]['pd_sub_file1']);
        // 썸네일삭제
        if(preg_match("/\.({$config['cf_image_extension']})$/i", $write_sub[$i]['pd_sub_file1'])) {
            delete_pd_thumbnail($write_sub[$i]['pd_sub_file1']);
        }
    }

    $tmp_file  = $_FILES['pd_sub_file']['tmp_name'][$i];
    $filesize  = $_FILES['pd_sub_file']['size'][$i];
    $filename  = $_FILES['pd_sub_file']['name'][$i];
    $filename  = get_safe_filename($filename);

    // 서버에 설정된 값보다 큰파일을 업로드 한다면
    if ($filename) {
        if ($_FILES['pd_sub_file']['error'][$i] == 1) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$supload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
            continue;
        }
        else if ($_FILES['pd_sub_file']['error'][$i] != 0) {
            $file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
            continue;
        }
    }

    if (is_uploaded_file($tmp_file)) {
        // 관리자가 아니면서 설정한 업로드 사이즈보다 크다면 건너뜀
        if (!$is_admin && $filesize > $qaconfig['pd_upload_size']) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량('.number_format($filesize).' 바이트)이 게시판에 설정('.number_format($qaconfig['pd_upload_size']).' 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n';
            continue;
        }

        //=================================================================\
        // 090714
        // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
        // 에러메세지는 출력하지 않는다.
        //-----------------------------------------------------------------
        $timg = @getimagesize($tmp_file);
        // image type
        if ( preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
             preg_match("/\.({$config['cf_flash_extension']})$/i", $filename) ) {
            if ($timg['2'] < 1 || $timg['2'] > 16)
                continue;
        }

        //=================================================================
        if ($w == 'u') {
            // 존재하는 파일이 있다면 삭제합니다.
            @unlink(G5_DATA_PATH.'/product/'.$write['pd_sub_file'.$i]);
            // 이미지파일이면 썸네일삭제
            if(preg_match("/\.({$config['cf_image_extension']})$/i", $write['pd_sub_file'.$i])) {
                delete_pd_thumbnail($row['pd_sub_file'.$i]);
            }
        }        

        // 프로그램 원래 파일명
        $supload[$i]['source'] = $filename;
        $supload[$i]['filesize'] = $filesize;

        // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
        $filename = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

        shuffle($chars_array);
        $shuffle = implode('', $chars_array);

        // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
        $supload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

        $dest_file = G5_DATA_PATH.'/product/'.$supload[$i]['file'];

        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['pd_sub_file']['error'][$i]);

        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);
    }
}
*/

if($pd_cate1 == 1)$pd_cate2 = $pd_cate2;
else $pd_cate2 = $pd_cate3;

if($w == '' || $w == 'a' || $w == 'r') {
    if($w == '' || $w == 'r') {
        $row = sql_fetch(" select MIN(pd_num) as min_pd_num from {$g5['pd_content_table']} ");
        $pd_num = $row['min_pd_num'] - 1;
    }

    if($w == 'a') {
        $pd_num = $write['pd_num'];
        $pd_parent = $write['pd_num'];
        $pd_related = $write['pd_related'];
        $pd_category = $write['pd_category'];
        $pd_type = 1;
        $pd_status = 1;
    }

    $sql = " insert into {$g5['pd_content_table']}
                set pd_cate1            = '$pd_cate1',
                    pd_cate2            = '$pd_cate2',
                    pd_cate3            = '$category[2]',
                    pd_pos1            = '$pd_pos1',
                    pd_pos2            = '$position[1]',
                    pd_pos3            = '$position[2]',
                    pd_1            = '$pd_1',
                    pd_2            = '$pd_2',
                    pd_3            = '$pd_3',
                    pd_4            = '$pd_4',
                    pd_5            = '$pd_5',
                    pd_6            = '$pd_6',
                    pd_7            = '$pd_7',
                    pd_8            = '$pd_8',
                    pd_9            = '$pd_9',
                    pd_10            = '$pd_10',
                    pd_text1            = '$pd_text1',
                    pd_text2            = '$pd_text2',
                    pd_text3            = '$pd_text3',
                    pd_text4            = '$pd_text4',
                    pd_text5            = '$pd_text5',                    
                    pd_img1        = '{$iupload[1]['file']}',
                    pd_img_source1      = '{$iupload[1]['source']}',
                    pd_img2        = '{$iupload[2]['file']}',
                    pd_img_source2      = '{$iupload[2]['source']}',
                    pd_img3        = '{$iupload[3]['file']}',
                    pd_img_source3      = '{$iupload[3]['source']}',
                    pd_img4        = '{$iupload[4]['file']}',
                    pd_img_source4      = '{$iupload[4]['source']}',
                    pd_img5        = '{$iupload[5]['file']}',
                    pd_img_source5      = '{$iupload[5]['source']}',
                    pd_file1        = '{$upload[1]['file']}',
                    pd_source1      = '{$upload[1]['source']}',
                    pd_file2        = '{$upload[2]['file']}',
                    pd_source2      = '{$upload[2]['source']}',
                    pd_file3        = '{$upload[3]['file']}',
                    pd_source3      = '{$upload[3]['source']}',
                    pd_file4        = '{$upload[4]['file']}',
                    pd_source4      = '{$upload[4]['source']}',
                    pd_file5        = '{$upload[5]['file']}',
                    pd_source5      = '{$upload[5]['source']}',
                    pd_file6        = '{$upload[6]['file']}',
                    pd_source6      = '{$upload[6]['source']}',
                    pd_file7        = '{$upload[7]['file']}',
                    pd_source7      = '{$upload[7]['source']}',
                    pd_file8        = '{$upload[8]['file']}',
                    pd_source8      = '{$upload[8]['source']}',
                    pd_file9        = '{$upload[9]['file']}',
                    pd_source9      = '{$upload[9]['source']}',
                    pd_file10        = '{$upload[10]['file']}',
                    pd_source10      = '{$upload[10]['source']}',                                                                                
                    pd_regdate      = '".G5_TIME_YMDHIS."'";
    sql_query($sql);

    /*
    if($w == '' || $w == 'r') {
        $pd_num = sql_insert_id();
    }

    foreach($supload as $sitem){
        if($sitem['file'] != ''){
            $sql = " insert into {$g5['pd_sub_table']}
            set pd_num = '{$pd_num}',
                pd_sub_text        = '{$sitem['text']}',
                pd_sub_file1        = '{$sitem['file']}',
                pd_sub_source1      = '{$sitem['source']}'";
            sql_query($sql);
        }
    }
    */

} else if($w == 'u') {
    for($i=1;$i <= 5;$i++){
        if(!$iupload[$i]['file'] && !$iupload[$i]['del_check']) {
            $iupload[$i]['file'] = $write['pd_img'.$i];
            $iupload[$i]['source'] = $write['pd_img_source'.$i];
        }
    }

    for($i=1;$i <= 10;$i++){
        if(!$upload[$i]['file'] && !$upload[$i]['del_check']) {
            $upload[$i]['file'] = $write['pd_file'.$i];
            $upload[$i]['source'] = $write['pd_source'.$i];
        }
    }

    $sql = " update {$g5['pd_content_table']}
                set pd_cate1            = '$pd_cate1',
                pd_cate2            = '$pd_cate2',
                pd_cate3            = '$category[2]',
                pd_pos1            = '$pd_pos1',
                pd_pos2            = '$position[1]',
                pd_pos3            = '$position[2]',
                pd_1            = '$pd_1',
                pd_2            = '$pd_2',
                pd_3            = '$pd_3',
                pd_4            = '$pd_4',
                pd_5            = '$pd_5',
                pd_6            = '$pd_6',
                pd_7            = '$pd_7',
                pd_8            = '$pd_8',
                pd_9            = '$pd_9',
                pd_10            = '$pd_10',
                pd_text1            = '$pd_text1',
                pd_text2            = '$pd_text2',
                pd_text3            = '$pd_text3',
                pd_text4            = '$pd_text4',
                pd_text5            = '$pd_text5',                    
                pd_img1        = '{$iupload[1]['file']}',
                pd_img_source1      = '{$iupload[1]['source']}',
                pd_img2        = '{$iupload[2]['file']}',
                pd_img_source2      = '{$iupload[2]['source']}',
                pd_img3        = '{$iupload[3]['file']}',
                pd_img_source3      = '{$iupload[3]['source']}',
                pd_img4        = '{$iupload[4]['file']}',
                pd_img_source4      = '{$iupload[4]['source']}',
                pd_img5        = '{$iupload[5]['file']}',
                pd_img_source5      = '{$iupload[5]['source']}',
                pd_file1        = '{$upload[1]['file']}',
                pd_source1      = '{$upload[1]['source']}',
                pd_file2        = '{$upload[2]['file']}',
                pd_source2      = '{$upload[2]['source']}',
                pd_file3        = '{$upload[3]['file']}',
                pd_source3      = '{$upload[3]['source']}',
                pd_file4        = '{$upload[4]['file']}',
                pd_source4      = '{$upload[4]['source']}',
                pd_file5        = '{$upload[5]['file']}',
                pd_source5      = '{$upload[5]['source']}',
                pd_file6        = '{$upload[6]['file']}',
                pd_source6      = '{$upload[6]['source']}',
                pd_file7        = '{$upload[7]['file']}',
                pd_source7      = '{$upload[7]['source']}',
                pd_file8        = '{$upload[8]['file']}',
                pd_source8      = '{$upload[8]['source']}',
                pd_file9        = '{$upload[9]['file']}',
                pd_source9      = '{$upload[9]['source']}',
                pd_file10        = '{$upload[10]['file']}',
                pd_source10      = '{$upload[10]['source']}'";
    $sql .= " where pd_num = '$pd_num' ";
    sql_query($sql);

    /*
    foreach($supload as $sitem){
        if($sitem['num'] == ''){
            if($sitem['file'] != ''){
                $sql = " insert into {$g5['pd_sub_table']}
                set pd_num = '$pd_num',
                    pd_sub_text        = '{$sitem['text']}',
                    pd_sub_file1        = '{$sitem['file']}',
                    pd_sub_source1      = '{$sitem['source']}'";
                    sql_query($sql);
            }
        }else if($sitem['del_check']){
            sql_query(" delete from {$g5['pd_sub_table']} where pd_sub_num = '{$sitem['num']}' ");
        }else{
            $sql = " update {$g5['pd_sub_table']}
            set pd_sub_text        = '{$sitem['text']}'";
                if($sitem['file'] != ''){
                    $sql .= ",pd_sub_file1        = '{$sitem['file']}',
                    pd_sub_source1      = '{$sitem['source']}'";
                }
            $sql .= " where pd_sub_num = '{$sitem['num']}' ";            
            sql_query($sql);
        }
        
    }    
    */
}
//run_event('qawrite_update', $pd_num, $write, $w, $qaconfig);
if($w == 'a'){
    $result_url = 'pd_view.php?pd_num='.$pd_num.$qstr;
}else if($w == 'u' && $write['pd_type']){
    $result_url = 'pd_view.php?pd_num='.$write['pd_parent'].$qstr;
}else{
    $qstr = "?cate1=$pd_cate1&cate2=$pd_cate2&position=$pd_pos1";
    $result_url = 'pd_list.php'.preg_replace('/^&amp;/', '?', $qstr);
}

if ($file_upload_msg)
    alert($file_upload_msg, $result_url);
else
    goto_url($result_url);


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