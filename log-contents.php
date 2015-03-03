<?php
include 'lib/chat.php';
include 'lib/function.php';

session_start();
$name = $_SESSION['name'];

$chat = new Chat(h($_GET['path']));
$chatData = $chat->read();

ob_flush();
flush();

$data = array(
	'chatData' => $chatData,
	'name' => $name
);
view('log-contents_view.php', $data);
