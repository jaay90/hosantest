<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$qa_skin_url.'/style.css">', 0);
?>
<form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="qa_id" value="<?php echo $qa_id ?>">
<input type="hidden" name="sca" value="<?php echo $sca ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="<?php echo $token ?>">
<?php
$option = '';
$option_hidden = '';
$option = '';

if ($is_dhtml_editor) {
    $option_hidden .= '<input type="hidden" name="qa_html" value="1">';
} else {
    $option .= "\n".'<input type="checkbox" id="qa_html" name="qa_html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="qa_html">html</label>';
}

echo $option_hidden;
?>
<div class="txtTit">
    <div class="pb32 ">
        <span class="font20">개인정보</span> <span class="textbold font20">수집 및 이용에 대한 동의</span><span class="textred"> &ensp;(필수)</span>
    </div>				
    <div class="txtArea">
        <p class="p18_2 textbold">개인정보취급방침</p>
        <p class="pL20_text">호산물산㈜(이하 '회사'는) 이용자의 개인정보를 중요시하며, 「정보통신망 이용촉진 및 정보보호 등에 관한 법률」, 「개인정보보호법」을 준수하기 위하여 노력하고 있습니다. 회사는 「개인정보 보호법」 제30조에 따라 정보주체의 개인정보를 보호하고 이와 관련한 고충을 신속하고 원활하게 처리할 수 있도록 하기 위하여 다음과 같이 개인정보 처리방침을 수립·공개합니다. 본 개인정보취급방침은 2021년 4월 23일부터 시행되며 이를 개정하는 경우 변경된 내용을 정보주체가 쉽게 확인 할 수 있도록 웹사이트 공지사항(또는 개별공지)을 통하여 공지하겠습니다.</p>

        <p class="p18_2 textbold">1. 개인정보의 처리목적</p>
        <p class="pL20_text">회사는 다음의 목적을 위하여 개인정보를 처리합니다. 처리한 개인정보는 다음의 목적 이외의 용도로는 이용되지 않으며 이용 목적이 변경되는 경우에는 「개인정보 보호법」 제18조에 따라 별도의 동의를 받는 등 필요한 조치를 이행할 예정입니다.<br><br>- 개인 식별, 상담, 불만처리 등 민원처리, 고지사항 전달</p>

        <p class="p18_2 textbold">2. 개인정보의 처리 및 보유기간</p>
        <p class="pL20_text">회사는 법령에 따른 개인정보 보유, 이용기간 또는 정보주체로부터 개인정보 수집 시에 동의 받은 개인정보 보유, 이용기간 내에서 개인정보를 처리 및 보유합니다.<br><br>개인정보 보유 기간 : 소비자의 불만 또는 분쟁처리가 완료된 시점<br><br>다만, 다음의 사유에 해당하는 경우에는 해당 사유 종료 시까지<br>- 관계 법령위반에 따른 수사조사 등이 진행 중인 경우에는 해당 수사조사 종료 시까지<br>- 홈페이지 이용에 따른 채권,채무관계 잔존 시에는 해당 채권,채무관계 정산 시까지</p>

        <p class="p18_2 textbold">3. 개인정보의 제3자 제공</p>
        <p class="pL20_text">회사는 이용자의 개인정보를 원칙적으로 외부에 제공하지 않습니다. 다만, 아래의 경우에는 예외로 합니다.<br><br>- 법령의 규정에 의거하거나, 수사 목적으로 법령에 정해진 절차와 방법에 따라 수사기관의 요구가 있는 경우<br>- 정보주체 또는 그 법정대리인이 의사표시를 할 수 없는 상태에 있거나 주소불명 등으로 사전동의를 받을 수 없는 경우로서<br>&ensp; 명백히 정보주체 또는 제3자의 급박한 생명, 신체, 재산의 이익을 위하여 필요하다고 인정되는 경우<br>- 통계작성, 학술연구나 시장조사를 위해 특정 개인을 식별할 수 없는 형태로 가공하여 제공하는 경우<br>- 이용자들이 사전에 동의한 경우</p>

        <p class="p18_2 textbold">4. 수집한 개인정보의 위탁</p>
        <p class="pL20_text">회사는 고객의 동의 없이 개인정보를 외부업체에 위탁하지 않습니다. 향후 원활한 개인정보 업무처리를 위하여 개인정보를 위탁하는 경우, 위탁 대상자와 위탁 업무 내용에 대해 고객에게 통지하고 필요한 경우 사전 동의를 받도록 하겠습니다.</p>

        <p class="p18_2 textbold">5. 정보주체의 권리·의무 및 행사방법</p>
        <p class="pL20_text">정보의 주체는 다음 각 호의 개인정보 보호 관련 권리를 행사할 수 있습니다.<br><br>- 개인정보 열람요구<br>- 오류 등이 있을 경우 정정요구<br>- 삭제요구<br>- 처리정지 요구<br><br>
        제1항에 따른 권리 행사는 서면, 전자우편, FAX 등을 통하여 하실 수 있으며 회사는 이에 대해 지체 없이 조치하겠습니다. 정보주체가 개인정보의 오류 등에 대한 정정 또는 삭제를 요구한 경우에는 회사는 정정 또는 삭제를 완료할 때까지 당해 개인정보를 이용하거나 제공하지 않습니다. 제1항에 따른 권리 행사는 정보주체의 법정대리인이나 위임을 받은 자 등 대리인을 통하여 하실 수 있습니다. 이 경우 개인정보 보호법 시행규칙 제11호 서식에 따른 위임장을 제출해야 합니다. 정보주체는 개인정보 보호법 등 관례법령을 위반하여 회사가 처리하고 있는 정보주체 본인이나 타인의 개인정보 및 사생활을 침해하여서는 아니됩니다.</p>

        <p class="p18_2 textbold">6. 처리하는 개인정보 항목</p>
        <p class="pL20_text">회사는 상담, 서비스 신청 등을 위해 아래와 같은 개인정보를 수집하고 있습니다.<br><br>- 수집항목(고객문의) : 성명, 연락처, 이메일, 회사명, 직책, 부서, 주소<br> &ensp;인터넷 서비스 이용과정에서 아래 개인정보 항목이 자동으로 생성되어 수집될 수 있습니다<br>&ensp; : 성명, 연락처, 이메일, 인터넷 서비스 이용과정에서 자동으로 생성되어 수집되는 정보(ip,cookie 등)</p>

        <p class="p18_2 textbold">7. 개인정보의 파기</p>
        <p class="pL20_text">회사는 개인정보 보유기간의 경과, 처리목적 달성 등 개인정보가 불필요하게 되었을 때에는 지체없이 해당 개인정보를 파기합니다.<br> 정보주체로부터 동의받은 개인정보 보유기간이 경과하거나 처리목적이 달성되었음에도 불구하고 다른 법령에 따라 개인정보를 계속 보존하여야 하는 경우에는, 해당 개인정보를 별도의 데이터베이스(DB)로 옮기거나 보관장소를 달리하여 보존합니다. 회사는 파기 사유가 발생한 개인정보를 선정하고, 회사의 개인정보 보호책임자의 승인을 받아 개인정보를 파기합니다. 회사는 전자적 파일 형태로 기록, 저장된 개인정보는 기록을 재생할 수 없도록 기술적 방법을 이용하여 파기하며, 종이 문서에 기록, 저장된 개인정보는 분쇄기로 분쇄하거나 소각하여 파기합니다.</p>

        <p class="p18_2 textbold">8. 개인정보의 안전성 확보조치</p>
        <p class="pL20_text">회사는 개인정보의 안전성 확보를 위해 다음과 같이 조치를 취하고 있습니다.<br><br>- 관리적 조치 : 내부관리계획 수립 및 시행, 정기적 직원 교육 등<br>- 기술적 조치 : 개인정보처리시스템 등의 접근권한 관리, 접근통제시스템 설치, 고유식별정보 등의 암호화, 보안프로그램 설치<br>- 물리적 조치 : 전산실, 자료보관실 등의 접근통제</p>

        <p class="p18_2 textbold">9. 개인정보 보호책임자</p>
        <p class="pL20_text">회사는 개인정보 처리에 관한 업무를 총괄해서 책임지고, 개인정보 처리와 관련한 정보주체의 불만처리 및 피해구제 등을 위하여 아래와 같이 개인정보 보호책임자를 지정하고 있습니다.<br><br>- 개인정보 보호책임자 : 이름 / 전화번호/ 이메일<br><br>정보주체는 회사의 서비스(또는 사업)을 이용하면서 발생한 모든 개인정보 보호 관련 문의, 불만처리, 피해구제 등에 관한 사항을 개인정보 보호책임자에게 문의할 수 있습니다. 회사는 정보주체의 문의에 대해 지체없이 답변 및 처리해드릴 것입니다.</p>

        <p class="p18_2 textbold">10. 권익침해 구제방법</p>
        <p class="pL20_text">정보주체는 개인정보 침해로 인한 구제를 받기 위하여 개인정보분쟁조정위원회, 한국인터넷진흥원 개인정보침해신고센터 등에 분쟁해결이나 상담 등을 신청할 수 있습니다. 이 밖에 기타 개인정보침해의 신고 및 상담에 대하여는 아래의 기관에 문의할 수 있습니다.<br><br>- 개인정보분쟁조정위원회(www.kopico.go.kr) : (국번없이) 1833-6972<br>- 개인정보 침해신고센터(http://www.privacy.kisa.or.kr) : (국번없이) 118<br>- 대검찰청 사이버범죄수사단(http://www.spo.go.kr/) : (국번없이) 1301<br>- 경찰청 사이버안전국(http://cyberbureau.police.go.kr/) : (국번없이) 182</p>

    </div>
    <div class="option">
        <p>위 개인정보 수집·이용에 동의합니다.</p>
        <div class="clfix radioArea">
            <label class="radioWrap">동의합니다.
                <input type="radio" checked="checked" name="radio" />
                <span class="checkmark"></span>
            </label>
            <label class="radioWrap">동의하지 않습니다.
                <input type="radio" name="radio" />
                <span class="checkmark"></span>
            </label>
        </div>
    </div>
</div>
<div class="pb32 pt100 qnainfo">
        <span class="font20">기본정보 및</span> <span class="textbold font20"> 문의내용</span><span class="textred checkicleft"> &ensp;필수 입력 항목입니다.</span>
</div>
<div class="qna-table">
    <table>
        <caption>1:1문의 작성란</caption>
        <colgroup>
            <col style="" />
            <col style="" />
        </colgroup>
        <tbody>
            <tr>
                <th class="checkicright">이름</th>
                <td>
                <input type="text" name="qa_name" required placeholder="이름을 입력하세요." class="mSize"/>
                </td>
            </tr>
            <tr>
                <th class="checkicright">연락처</th>
                <td>                    
                    <input type="text" name="qa_hp" class="mSize" required value="<?php echo get_text($write['qa_hp']); ?>" id="qa_hp" <?php echo $req_hp; ?> class="<?php echo $req_hp.' '; ?>frm_input full_input" size="30" placeholder="연락처를 입력하세요.">
                </td>
            </tr>
            <tr>
                <th class="checkicright">이메일</th>
                <td>
                    <input type="text" name="qa_email" class="mSize" required value="<?php echo get_text($write['qa_email']); ?>" id="qa_email" <?php echo $req_email; ?> class="<?php echo $req_email.' '; ?>frm_input full_input email" size="50" maxlength="100" placeholder="이메일을 입력하세요.">
                </td>
            </tr>
            <tr>
                <th class="checkicright">제목</th>
                <td>
                    <input type="text" name="qa_subject" class="megaSize" value="<?php echo get_text($write['qa_subject']); ?>" id="qa_subject" required class="frm_input full_input required" size="50" maxlength="255" placeholder="제목">        
                </td>
            </tr>
            <tr>
                <th class="checkicright">내용</th>
                <td>
                    <textarea name="qa_content" id="qa_content" cols="30" rows="10" class="megaSize"></textarea>
                </td>
            </tr>
            <tr>
                <th >첨부파일</th>
                <td>
                    <input type="file" name="bf_file[1]" id="bf_file_1" title="파일첨부 1 :  용량 <?php echo $upload_max_filesize; ?> 이하만 업로드 가능" class="frm_file">
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="btnArea">
    <button type="submit" id="btn_submit" accesskey="s" class="btnL">문의보내기</button>    
    <a href="<?php echo $list_href; ?>" class="btnR">취소</a>
</div>
</form>
    <script>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "2";
            else
                obj.value = "1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.qa_subject.value,
                "content": f.qa_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.qa_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_qa_content) != "undefined")
                ed_qa_content.returnFalse();
            else
                f.qa_content.focus();
            return false;
        }

        <?php if ($is_hp) { ?>
        var hp = f.qa_hp.value.replace(/[0-9\-]/g, "");
        if(hp.length > 0) {
            alert("휴대폰번호는 숫자, - 으로만 입력해 주십시오.");
            return false;
        }
        <?php } ?>

        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.write.token.php",
            data: { 'token_case' : 'qa_write' },
            cache: false,
            async: false,
            dataType: "json",
            success: function(data) {
                if (typeof data.token !== "undefined") {
                    token = data.token;

                    if(typeof f.token === "undefined")
                        $(f).prepend('<input type="hidden" name="token" value="">');

                    $(f).find("input[name=token]").val(token);
                }
            }
        });

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->