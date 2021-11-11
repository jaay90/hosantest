<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
$pd_skin_url = G5_URL."/mobile/skin/product/basic";
add_stylesheet('<link rel="stylesheet" href="'.$pd_skin_url.'/style.css">', 0);
?>

        <div class="container pdregister">
            <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="w" value="<?php echo $w ?>">
            <input type="hidden" name="pd_num" value="<?php echo $pd_num ?>">
            <input type="hidden" name="sca" value="<?php echo $sca ?>">
            <input type="hidden" name="stx" value="<?php echo $stx ?>">
            <input type="hidden" name="page" value="<?php echo $page ?>">
            <?php
            $option = '';
            $option_hidden = '';
            $option = '';

            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" name="pd_html" value="1">';
            } else {
                $option .= "\n".'<input type="checkbox" id="pd_html" name="pd_html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.' class="selec_chk">'."\n".'<label for="pd_html"><span></span>html</label>';
            }

            echo $option_hidden;
            ?> 
		    <div class="pd_w_field"><b>제품 브랜드 선택</b></div>
		    
		    <input type="radio" name="pd_cate1" value="1" id="category-hosan" class="category-radio" <?if($cate1 == 1){?>checked<?}?>>
		    <label for="category-hosan" class="category-select">A+ Hosan</label>
		    
		    <input type="radio" name="pd_cate1" value="2" id="category-national" class="category-radio" <?if($cate1 == 2){?>checked<?}?>>
		    <label for="category-national" class="category-select">national Brand</label>
		    
		    <div class="pd-category1">
		    	<div class="pd_w_field "><b>제품 카테고리 분류</b></div>
		      <div class="pd-categorydt category-hosan">
		      	<div class="selectholder">
					    <label>A+ Hosan 2차 분류</label>
					    <select name="pd_cate2" id="projectstart">
					      <option value="0">A+ Hosan 2차 분류</option>
					      <option value="음료류"<?if($cate2 == "음료류"){?> selected<?}?>>음료류</option>
					      <option value="김류"<?if($cate2 == "김류"){?> selected<?}?>>김류</option>
					      <option value="국수류"<?if($cate2 == "국수류"){?> selected<?}?>>국수류</option>
					      <option value="우동류"<?if($cate2 == "우동류"){?> selected<?}?>>우동류</option>
					      <option value="차류"<?if($cate2 == "차류"){?> selected<?}?>>차류</option>
					      <option value="냉동가공식품류"<?if($cate2 == "냉동가공식품류"){?> selected<?}?>>냉동가공식품류</option>
					      <option value="냉동수산물"<?if($cate2 == "냉동수산물"){?> selected<?}?>>냉동수산물</option>
					      <option value="김치"<?if($cate2 == "김치"){?> selected<?}?>>김치</option>
					      <option value="기타"<?if($cate2 == "기타"){?> selected<?}?>>기타</option>
					    </select>
					  </div>
		      </div>

		      <div class="pd-categorydt category-national">
		      	<div class="selectholder">
					    <label>National Brand 2차 분류</label>
					    <select name="pd_cate3" id="projectstart">
					      <option value="0">National Brand 2차 분류</option>
					      <option value="과자"<?if($cate2 == "과자"){?> selected<?}?>>과자</option>
					      <option value="인스턴트 라면(팩/컵/봉지)"<?if($cate2 == "인스턴트 라면(팩/컵/봉지)"){?> selected<?}?>>인스턴트 라면(팩/컵/봉지)</option>
					      <option value="소스"<?if($cate2 == "소스"){?> selected<?}?>>소스</option>
					      <option value="기타"<?if($cate2 == "기타"){?> selected<?}?>>기타</option>
					    </select>
					  </div>
		      </div>
		    </div>
				
				<ul>
					<li class="pd_w_field pd_w_check">
						<input type="checkbox" id="checkbox" name="pd_pos1"<?if($write['pd_pos1']){echo ' checked';}?>>
  					<label for="checkbox">신제품</label>
  					<span>*신제품일 경우 체크해주세요.</span>
					</li>
					<li class="pd_w_field">
		          <label for="pd_1">제품명</label>
		          <input type="text" name="pd_1" value="<?php echo get_text($write['pd_1']); ?>" id="pd_name" required="" class="" maxlength="255" placeholder="제품명을 입력하세요">
		      </li>
		      <li class="pd_w_field">
		          <label for="pd_1">제품 용량</label>
		          <input type="text" name="pd_3" value="<?php echo get_text($write['pd_3']); ?>" id="pd_volume" required="" class="" maxlength="255" placeholder="제품 용량을 입력하세요">
		      </li>
		      <li class="file_wr filebox">
			    	<label for="pd_img1">대표이미지</label>
			    	<input type="text" class="fileName" readonly="readonly" placeholder="대표이미지를 첨부하세요">
			    	<label for="pd_img1"><span class="btn_file">파일첨부</span></label>
			    	<input type="file" name="pd_img[1]" id="pd_img1" title="파일첨부 1 :  용량 100,000 바이트 이하만 업로드 가능" class="frm_file uploadBtn">
                    <?php if($w == 'u' && $write['pd_img1']) { ?>
                        <input type="checkbox" id="pd_img_del1" name="pd_img_del1" value="1">
                        <label for="pd_img_del1"><?php echo $write['pd_img_source1']; ?> 파일 삭제</label>
                    <?php } ?>                    
			    </li>
			    <li class="file_wr filebox">
			    	<label for="pd_file1">상세이미지</label>
			    	<input type="text" class="fileName" readonly="readonly" placeholder="상세이미지를 첨부하세요">
			    	<label for="pd_file1"><span class="btn_file">파일첨부</span></label>
			    	<input type="file" name="pd_file[1]" id="pd_file1" title="파일첨부 2 :  용량 100,000 바이트 이하만 업로드 가능" class="frm_file uploadBtn">
                    <?php if($w == 'u' && $write['pd_file1']) { ?>
                        <input type="checkbox" id="pd_file_del1" name="pd_file_del[1]" value="1">
                        <label for="pd_file_del1"><?php echo $write["pd_source1"]; ?> 파일 삭제</label>
                    <?php } ?>                    
			    </li>
				</ul>
				<div class="btn_confirm">
                <a href="<?php echo $list_href; ?>" class="btn_pd">취소</a>
		        <button type="submit" id="btn_submit" accesskey="s" class="btn_pd">제품 등록</button>
		    </div>
		    
		  </form>
		</div>

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
        <?php echo $summary_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        <?php echo $content_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        /*
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.pd_subject.value,
                "content": f.pd_content.value
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
            f.pd_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_pd_content) != "undefined")
                ed_pd_content.returnFalse();
            else
                f.pd_content.focus();
            return false;
        }
        */

        <?php if ($is_hp) { ?>
        var hp = f.pd_hp.value.replace(/[0-9\-]/g, "");
        if(hp.length > 0) {
            alert("휴대폰번호는 숫자, - 으로만 입력해 주십시오.");
            return false;
        }
        <?php } ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }

    $('#btn_detail').on('click',function(){
        $('#fwrite').attr('action', 'pd_detail_update.php');
        $('#fwrite').attr('onsubmit', '');
        $('#fwrite').submit();
    });

    var uploadFile = $('.filebox .uploadBtn');
	uploadFile.on('change', function(){
		if(window.FileReader){
			var filename = $(this)[0].files[0].name;
		} else {
			var filename = $(this).val().split('/').pop().split('\\').pop();
		}
		$(this).siblings('.fileName').val(filename);
	});
    </script>
</div>
</div>
<!-- } 게시물 작성/수정 끝 -->