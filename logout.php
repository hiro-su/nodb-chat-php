<?php
session_start();

//セッション情報削除
$_SESSION = array();
if(ini_get("session.use_cookies")){
	setcookie(session_name(), '', $_SERVER['REQUEST_TIME']-4200, '/');
}
session_destroy();

//認証ページにリダイレクト
header('Location: login.html');
?>
