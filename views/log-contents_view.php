<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style/log.css" type="text/css"/>
<title>ajax chat</title>
</head>
<body id="body">
<h2><a href="index.php?name=<?= $name ?>">Home</a>&nbsp;<a href="log.php">Log</a></h2>
<div id="wrapper">
<div id="chat_wrapper">
<div id="chat_inner">
<label id="hoge_label">Chat Window</label>
<div id="hoge"><ul id="chat"><?= $chatData ?></ul></div>
</div>
</div>
</div>
<script type="text/javascript" src="js/load.js"></script>
</body>
</html>
