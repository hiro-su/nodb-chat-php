<?php
class Count{
	private static $file, $now;

	public function __construct($file){
		self::$file = $file;
		self::$now = $_SERVER['REQUEST_TIME'];
		unset($file);
	}

	public function setUserList($name, $limitTime){
		$currentAddr = $_SERVER['REMOTE_ADDR'];
		if(is_file(self::$file)){
			$users = file(self::$file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); 
			$fp = fopen(self::$file, "w"); 
			flock($fp, LOCK_EX);
			foreach($users as $user){
				list($uname, $address, $stamp) = unserialize($user);
				if((self::$now-$stamp) < $limitTime && $address !== $currentAddr) { //limitTimeより小さく、IPアドレスが違う場合に書き込み
					fwrite($fp, serialize(array($uname, $address, $stamp))."\n"); 
				} 
				unset($uname, $address, $stamp, $user);
			} 
			fwrite($fp, serialize(array($name, $currentAddr, self::$now))); 
			fclose($fp); 
		}else{
			file_put_contents(self::$file, '', LOCK_EX);
		}
		unset($users, $name, $currentAddr, $fp);
	}

	public function getUserList(){
		$list = $limit = null;
		$userList = array();
		if(is_file(self::$file)){
			$users = file(self::$file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); 
			foreach($users as $user){
				list($uname,,$stamp) = unserialize($user);
				$limit = self::$now - $stamp;
				$userList[] = "<li>$uname :: $limit</li>";
				unset($uname, $stamp, $limit, $user);
			}
			natcasesort($userList); //大小文字を区別しないで自然順序にソート
			$list = implode('', $userList); //配列を文字列に変換
			unset($users, $userList);
		}
		return $list;
	}
}
?>
