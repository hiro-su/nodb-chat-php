<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style/style.css" type="text/css"/>
<title>ajax chat</title>
</head>
<body id="body">
<h2><a href="index.php?name=<?= $name ?>">Home</a>&nbsp;<a href="log.php">Log</a></h2>
<div id="wrapper">
<div id="chat_wrapper">
<div id="chat_inner">
<label id="hoge_label">Chat Window</label>
<div id="hoge"><ul id="chat"><?= $read ?></ul></div>
</div>
<div id="member">
<label id="user_list_label">Users Online</label>
<div id="user_list"><ul><?= $member ?></ul></div>
<span id="reload_status"><label id="reload_status_label">Status -> Active</label><img src="image/start.gif" alt="start" /></span>
</div>
</div>
<div id="button">
<form method="post" name="chat" id="write">
<input type="text" name="name" value="<?= $name ?>" id="text_name"/>
<input type="text" name="text_data" id="text_data"/>
<input type="submit" name="send_data" value="write"/>
</form>
<form action="logout.php" id="logout">
<input type="submit" value="logout" />
</form>
</div>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/load.js"></script>
</body>
</html>
