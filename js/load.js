//読み込み時にloadChat()を実行
$(function(){
	//テキスト入力欄にフォーカスする
	$('#text_data').focus();

	//テキスト入力
	$('form#write').submit(function(){
		setChat();
		return false;
	});

	//読み込み
	loadChat();

	//自動リロード開始・停止
	reloadState();
});

var comet = 'start';
var flag = 'start';

//リロードステータス
function reloadState(){
	$('#reload_status').toggle(
		function(){
			$('#reload_status').html('<label id="reload_status_label">Status -> Stop</label><img src="image/stop.gif" alt="stop" />');
			flag = 'stop';
			comet = 'stop';
			alert("Auto Reload Stop");
		},
		function(){
			$('#reload_status').html('<label id="reload_status_label">Status -> Active</label><img src="image/start.gif" alt="start" />');
			flag = 'start';
			comet = 'start';
			alert("Auto Reload Start");
			document.chat.submit();
		}
	);
}

//書き込み
function setChat() {
	//postする値を取得
	var name = $('#text_name');
	var text = $('#text_data');

	if(name.val() && text.val()){
		$.ajax({
			url:'write.php',
			async:false,
			type:'post',
			data:{'name':name.val(), 'text':text.val()},
			success:function(){
				text.val('Sending...').attr('disabled', 'disabled');
				ajax = name = text = null;
			}
		});
	}
}

//読み込み
function loadChat() {
	//スクロール
	scrollBottom('hoge');

	$.ajax({
		url:'read.php',
		type:'post',
		data:{'comet':true},
		success:function(data){
			if(comet == 'start'){
				$('#hoge').html('<ul id="chat">'+data+'</ul>');
				$('#text_data').val('').removeAttr('disabled').focus();
				//ユーザリストの読み込み
				$.post('userList.php', function(data){ $('#user_list').html(data); });
				//Comet
				loadChat();
			}
		}
	});
}

function scrollBottom(id){
	var scroll = document.getElementById(id);
	scroll.scrollTop = scroll.scrollHeight - scroll.clientHeight;
	scroll = null;
}
