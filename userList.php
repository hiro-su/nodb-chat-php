<?php
include 'lib/count.php';
$config = parse_ini_file('config.ini');
$count = new Count($config['member_data']);
//���[�U���X�g�\��
echo $count->getUserList();
unset($config, $count);
