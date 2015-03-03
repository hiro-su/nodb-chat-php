<?php
set_time_limit(0);
include 'lib/chat.php';

$config = parse_ini_file('config.ini');
$chat = new Chat($config['chat_data']); //ライブラリインスタンス化
if(isset($_POST['comet'])){
	echo $chat->checkUpdate();
}else{
	echo $chat->read(); //チャットデータ読み込み
}
unset($config, $chat);
