<?


$categories = [ 
    [
        "code"=>"01",
        "text"=>"A+ Hosan",
        "children"=>
        [
            [
                "code"=>"0101",
                "text"=>"신제품"
            ],
            [
                "code"=>"0102",
                "text"=>"음료류"
            ],
            [
                "code"=>"0109",
                "text"=>"김류"
            ],            
            [
                "code"=>"0103",
                "text"=>"국수류"
            ],
            [
                "code"=>"0104",
                "text"=>"우동류"
            ],
            [
                "code"=>"0105",
                "text"=>"차료"
            ],
            [
                "code"=>"0106",
                "text"=>"냉동가공식품류"
            ],
            [
                "code"=>"0107",
                "text"=>"냉동수산물"
            ],
            [
                "code"=>"0108",
                "text"=>"김치"
            ],
            [
                "code"=>"0109",
                "text"=>"기타"
            ]
        ]
    ],
    [
        "code"=>"02",
        "text"=>"National Brand",
        "children"=>
        [
            [
                "code"=>"0201",
                "text"=>"과자"
            ],
            [
                "code"=>"0202",
                "text"=>"인스턴트 라면(팩/컵/봉지)"
            ],
            [
                "code"=>"0203",
                "text"=>"소스"
            ],
            [
                "code"=>"0204",
                "text"=>"기타"
            ]
        ]
    ]
];


function printCate($tree, $cl) {
    if(!is_null($tree) && count($tree) > 0) {
        echo '<ul class="'.$cl.'">';
        foreach($tree as $node) {
            echo '<li>'.'<input type="checkbox" id="ca_'.$node['code'].'" name="category[]" value="'.$node['code'].'" /><label for="ca_'.$node['code'].'">'. $node['text'] . '</label>';
            printCate($node['children'], "sub");
            echo '</li>';
        }
        echo '</ul>';
    }
}

function listCate($tree, $cl, $values) {
    if(!is_null($tree) && count($tree) > 0) {
        echo '<ul class="'.$cl.'">';
        foreach($tree as $node) {
            echo '<li>';
            echo '<input type="checkbox" id="ca_'.$node['code'].'" name="category[]" value="'.$node['code'].'"';
            if(!is_null($node['children'])){
                echo ' class="sub_all"';                
            }
            foreach($values as $value){
                if($value == $node['code']){
                    echo ' checked';
                }
            }
            echo' />';
            if(is_null($node['children'])){
                echo '<label for="ca_'.$node['code'].'">'. $node['text'] . '</label>';
            }else{
                echo '<label>'. $node['text'] . '</label>';
            }
            listCate($node['children'], $cl."_sub", $values);
            echo '</li>';
        }
        echo '</ul>';
    }
}

function checkCate($tree, $cl,$values) {
    if(!is_null($tree) && count($tree) > 0) {
        echo '<ul class="'.$cl.'">';
        foreach($tree as $node) {
            echo '<li>';
            if(is_null($node['children'])){
                echo '<input type="checkbox" id="ca_'.$node['code'].'" name="category[]" value="'.$node['code'].'"';
                foreach($values as $value){
                    if($value == $node['code']){
                        echo ' checked';
                    }
                }
                echo' />';
            }
            echo '<label for="ca_'.$node['code'].'">'. $node['text'] . '</label>';
            checkCate($node['children'], $cl."_sub", $values);
            echo '</li>';
        }
        echo '</ul>';
    }
}

function optionCate($tree, $value) {
    if(!is_null($tree) && count($tree) > 0) {
        foreach($tree as $node) {            
            if(!is_null($node['children'])){
                echo '<optgroup label="'. $node['text'] . '">';
                optionCate($node['children'], $value);                
            }else{
                if($node['code'] == $value){
                    $checked = " selected";
                }else{
                    $checked = "";
                }
                echo '<option value="'.$node['code'].'" '.$checked.'>'. $node['text'] . '</option>';
            }
            if(!is_null($node['children'])){
                echo "</optgroup>";
            }
        }
    }
}

function textCate($tree, $value) {
    if(!is_null($tree) && count($tree) > 0) {
        foreach($tree as $node) {
            if($node['code'] == $value){
                return $node['text'];
            }
            if(!is_null($node['children'])){
                return textCate($node['children'], $value);
            }
        }
    }
}
?>