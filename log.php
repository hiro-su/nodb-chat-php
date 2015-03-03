<?php
include 'lib/chat.php';
include 'lib/function.php';

session_start();
$name = $_SESSION['name'];

//データファイル
$logFile = './data/old/';
$dir_handle = opendir($logFile);
$files = null;

if($dir_handle !== false){
	while(($file = readdir($dir_handle)) !== false){
		if($file !== '.' && $file !== '..'){
			$list = array('data-' => '', '.json' => '');
			$files .= '<a href="log-contents.php?path='.$logFile.$file.'">'.strtr($file, $list).'</a>';
		}
	}
	closedir($dir_handle);
}

$data = array(
	'files' => $files,
	'name' => $name
);
view('log_view.php', $data);
