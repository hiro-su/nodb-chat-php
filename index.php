<?php
include 'lib/chat.php';
include 'lib/count.php';
include 'lib/function.php';
$name = !empty($_REQUEST['name']) ? h($_REQUEST['name']) : header('Location: login.html');

session_start();
$_SESSION['name'] = $name;

//設定ファイル読み込み
$config = parse_ini_file('config.ini');

//データファイル
$chatFile = $config['chat_data'];
$memberFile = $config['member_data'];

//ライブラリインスタンス化
$chat = new Chat($chatFile);
$count = new Count($memberFile);

//過去データがある場合はログ出力する
$chat->checkLog();

//チャットデータの読み込み
$chatData = $chat->read();

//ユーザアクセスのパラメータを設定
$count->setUserList($name, $config['timeout']);

//ユーザアクセスデータの読み込み
$userData = $count->getUserList();

/**
 * @param name		ログインユーザ名
 * @param read		チャットデータ
 * @param member	ログインユーザ数
 */
$data = array(
	'name' => $name,
	'read' => $chatData,
	'member' => $userData
);
view('index_view.php', $data);
unset($data, $name, $chatData, $userData, $chat, $count);
