<?php
include 'lib/chat.php';
include 'lib/count.php';
include 'lib/function.php';
//パラメータが空の場合は処理停止
if(!isset($_POST['name'], $_POST['text'])){ die(); }
$config = parse_ini_file('config.ini');
$name = h($_POST['name']);
$text = h($_POST['text']);
//ライブラリインスタンス化
$chat = new Chat($config['chat_data']);
$count = new Count($config['member_data']);
//チャットデータを書き込み
$chat->write($name, $text);
//ユーザアクセスパラメータの設定
$count->setUserList($name, $config['timeout']);

unset($config, $name, $text, $chat, $count);
