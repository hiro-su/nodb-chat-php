<?php
//特殊文字をエスケープ
function h($request){
	return htmlspecialchars($request, ENT_QUOTES, 'UTF-8');
}

//独自テンプレートエンジン
function view($_template, $data){
	foreach($data as $key => $value){
		//テンプレートで使用する変数を生成
		$$key = $value;
	}
	//$dataを破棄
	unset($data);
	include 'views/'.$_template;
}
?>
