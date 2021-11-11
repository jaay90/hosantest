<?php
include_once('./_common.php');
define("G5_PD_URL", "/product");
define("G5_PD_DIR", "/product");

$g5['pd_content_table'] = "g5_product";
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
// $pd_id = isset($pd_id) ? (int) $pd_id : 0;

// if(trim($qaconfig['pd_category'])) {
//     if($w != 'a') {
//         $category = explode('|', $qaconfig['pd_category']);
//         if(!in_array($pd_category, $category))
//             alert('분류를 올바르게 지정해 주십시오.');
//     }
// } else {
//     alert('1:1문의 설정에서 분류를 설정해 주십시오');
// }
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

    $sql = " select * from {$g5['pd_content_table']} where pd_id = '$pd_id' ";
    $write = sql_fetch($sql);

    if($w == 'u') {
        if(!$write['pd_id'])
            alert('게시글이 존재하지 않습니다.\\n삭제되었거나 자신의 글이 아닌 경우입니다.');
    }
}

// 파일개수 체크
$file_count   = 0;
$upload_count = count($_FILES['df_file']['name']);

for ($i=1; $i<=$upload_count; $i++) {
    if($_FILES['df_file']['name'][$i] && is_uploaded_file($_FILES['df_file']['tmp_name'][$i]))
        $file_count++;
}

if($file_count > 2)
    alert('첨부파일을 2개 이하로 업로드 해주십시오.');

// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
@mkdir(G5_DATA_PATH.'/product', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/product', G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

// 가변 파일 업로드
$file_upload_msg = '';
$upload = array();
for ($i=1; $i<=count($_FILES['df_file']['name']); $i++) {
    $upload[$i]['file']     = '';
    $upload[$i]['source']   = '';
    $upload[$i]['del_check'] = false;

    // 삭제에 체크가 되어있다면 파일을 삭제합니다.
    if (isset($_POST['df_file_del'][$i]) && $_POST['df_file_del'][$i]) {
        $upload[$i]['del_check'] = true;
        @unlink(G5_DATA_PATH.'/product/'.$write['pd_file'.$i]);
        // 썸네일삭제
        if(preg_match("/\.({$config['cf_image_extension']})$/i", $write['pd_file'.$i])) {
            delete_pd_thumbnail($write['pd_file'.$i]);
        }
    }

    $tmp_file  = $_FILES['df_file']['tmp_name'][$i];
    $filesize  = $_FILES['df_file']['size'][$i];
    $filename  = $_FILES['df_file']['name'][$i];
    $filename  = get_safe_filename($filename);

    // 서버에 설정된 값보다 큰파일을 업로드 한다면
    if ($filename) {
        if ($_FILES['df_file']['error'][$i] == 1) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
            continue;
        }
        else if ($_FILES['df_file']['error'][$i] != 0) {
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
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['df_file']['error'][$i]);

        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);
    }
}

if($w == '' || $w == 'a' || $w == 'r') {
    if($w == '' || $w == 'r') {
        $row = sql_fetch(" select MIN(pd_num) as min_pd_num from {$g5['pd_content_table']} ");
        $pd_num = $row['min_pd_num'] - 1;
    }

    if($w == 'a') {
        $pd_num = $write['pd_num'];
        $pd_parent = $write['pd_id'];
        $pd_related = $write['pd_related'];
        $pd_category = $write['pd_category'];
        $pd_type = 1;
        $pd_status = 1;
    }

    $sql = " insert into {$g5['pd_content_table']}
                set pd_cate1            = '$pd_cate1',
                    pd_cate2            = '$pd_cate2',
                    pd_cate3            = '$pd_cate3',
                    pd_pos1            = '$pd_pos1',
                    pd_pos2            = '$pd_pos2',
                    pd_pos3            = '$pd_pos3',
                    pd_1            = '$pd_subject',
                    pd_2            = '$pd_content',
                    pd_3            = '$pd_3',
                    pd_4            = '$pd_4',
                    pd_5            = '$pd_5',
                    pd_6            = '$pd_6',
                    pd_file1        = '{$upload[1]['file']}',
                    pd_source1      = '{$upload[1]['source']}',
                    pd_file2        = '{$upload[2]['file']}',
                    pd_source2      = '{$upload[2]['source']}',
                    pd_regdate      = '".G5_TIME_YMDHIS."'";
    //sql_query($sql);

} else if($w == 'u') {
    if(!$upload[1]['file'] && !$upload[1]['del_check']) {
        $upload[1]['file'] = $write['pd_file1'];
        $upload[1]['source'] = $write['pd_source1'];
    }

    if(!$upload[2]['file'] && !$upload[2]['del_check']) {
        $upload[2]['file'] = $write['pd_file2'];
        $upload[2]['source'] = $write['pd_source2'];
    }

    $sql = " update {$g5['pd_content_table']}
                set pd_email    = '$pd_email',
                    pd_hp       = '$pd_hp',
                    pd_category = '$pd_category',
                    pd_html     = '$pd_html',
                    pd_subject  = '$pd_subject',
                    pd_content  = '$pd_content',
                    pd_file1    = '{$upload[1]['file']}',
                    pd_source1  = '{$upload[1]['source']}',
                    pd_file2    = '{$upload[2]['file']}',
                    pd_source2  = '{$upload[2]['source']}',
                    pd_1        = '$pd_1',
                    pd_2        = '$pd_2',
                    pd_3        = '$pd_3',
                    pd_4        = '$pd_4',
                    pd_5        = '$pd_5' ";
    if($pd_sms_recv)
        $sql .= ", pd_sms_recv = '$pd_sms_recv' ";
    $sql .= " where pd_id = '$pd_id' ";
    //sql_query($sql);
}

run_event('qawrite_update', $pd_id, $write, $w, $qaconfig);

if($w == 'a')
    $result_url = G5_PD_URL.'/pd_view.php?pd_id='.$pd_id.$qstr;
else if($w == 'u' && $write['pd_type'])
    $result_url = G5_PD_URL.'/pd_view.php?pd_id='.$write['pd_parent'].$qstr;
else
    $result_url = G5_PD_URL.'/pd_list.php'.preg_replace('/^&amp;/', '?', $qstr);

if ($file_upload_msg)
    alert($file_upload_msg, $result_url);
else
    goto_url($result_url);
?>