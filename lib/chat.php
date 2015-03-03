<?php
class Chat{
	private static $file, $data;

	public function __construct($file){
		self::$file = $file;
		self::$data = json_decode(file_get_contents($file), true); //連想配列形式でデコード
		unset($file);
	}

	//Chat write
	public function write($name, $text){
		$request = array('name'=>$name, 'text'=>$text, 'time'=>date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
		if(is_file(self::$file)){
			self::$data[] = $request;
		}else{
			self::$data = array($request);
		}
		file_put_contents(self::$file, json_encode(self::$data), LOCK_EX);
		unset($name, $text, $request);
	}

	//Chat read
	public function read(){
		$chat = null;
		if(is_file(self::$file)){
			$data = json_decode(file_get_contents(self::$file), true); //連想配列形式でデコード
			foreach($data as $value){
				$name = '<li id="name">'.$value['name'].'&nbsp;</li>';
				$text = '<li id="text">'.$value['text'].'&nbsp;</li>';
				$time = '<li id="time">'.$value['time'].'&nbsp;</li>';
				$chat .= $name.$text.$time;
				unset($name, $text, $time, $value);
			}
			unset($data);
		}
		return $chat;
	}

	//comet
	public function checkUpdate(){
		if(is_file(self::$file)){
			$comet = null;
			$temp = self::$data;

			while($temp === self::$data){
				$temp = json_decode(file_get_contents(self::$file), true); //連想配列形式でデコード
				usleep(500000); //0.5s
			}

			self::$data = $temp;
			$comet = $this->read();
			unset($temp);
		}
		return $comet;
	}

	//前日以降のデータを過去ログとしてdata/oldフォルダに保存
	public function checkLog(){
		if(is_file(self::$file) && !empty(self::$data)){
			$time = $stamp = null;
			$old = $current = array();
			$today = date('Y-m-d', $_SERVER['REQUEST_TIME']);
			$stamp = explode(' ',self::$data['0']['time']);

			if($stamp['0'] < $today){
				foreach(self::$data as $value){
					$time = explode(' ', $value['time']);
					if($time['0'] < $today){
						$old[] = $value; //過去ログとして保存
					}else{
						$current[] = $value; //過去ログに保存しない
					}
					unset($value);
				}
				file_put_contents('data/old/data-'.$time['0'].'.json', json_encode($old), LOCK_EX); //過去ログとして保存
				file_put_contents(self::$file, json_encode($current), LOCK_EX); //今日のログだけ保存
				unset($time, $old, $current);
			}
			unset($today, $stamp);
		}
	}
}
?>
