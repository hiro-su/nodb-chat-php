<?php
include 'lib/count.php';
$config = parse_ini_file('config.ini');
$count = new Count($config['member_data']);
//ユーザリスト表示
echo $count->getUserList();
unset($config, $count);
