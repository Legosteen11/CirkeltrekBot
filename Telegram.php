<?php
class Telegram {

	private $data = array();
	private $updates = array();

	public function getToken() {
		$bot_id = file_get_contents('./ignore/token');
	}
	
	public function __construct($bot_id) {
		$this->bot_id = $bot_id;
		$this->data = $this->getData();
	}

	public function endpoint($api, array $content, $post = true) {
		$url = 'https://api.telegram.org/bot' . $this->bot_id . '/' . $api;
		if ($post)
			$reply = $this->sendAPIRequest($url, $content);
		else
			$reply = $this->sendAPIRequest($url, array(), false);
		return json_decode($reply, true);
	}

	public function getMe() {
		return $this->endpoint("getMe", array(), false);
	}

	public function answerInlineQuery(array $content) {
		return $this->endpoint("answerInlineQuery", $content);
	}

	public function sendMessage(array $content) {
		return $this->endpoint("sendMessage", $content);
	}

	public function forwardMessage(array $content) {
		return $this->endpoint("forwardMessage", $content);
	}

	public function sendPhoto(array $content) {
		return $this->endpoint("sendPhoto", $content);
	}

	public function sendAudio(array $content) {
		return $this->endpoint("sendAudio", $content);
	}

	public function sendDocument(array $content) {
		return $this->endpoint("sendDocument", $content);
	}

	public function sendSticker(array $content) {
		return $this->endpoint("sendSticker", $content);
	}

	public function sendVideo(array $content) {
		return $this->endpoint("sendVideo", $content);
	}

	public function sendVoice(array $content) {
		return $this->endpoint("sendVoice", $content);
	}

	public function sendLocation(array $content) {
		return $this->endpoint("sendLocation", $content);
	}

	public function sendChatAction(array $content) {
		return $this->endpoint("sendChatAction", $content);
	}

	public function getUserProfilePhotos(array $content) {
		return $this->endpoint("getUserProfilePhotos", $content);
	}

	public function getFile($file_id) {
		$content = array('file_id' => $file_id);
		return $this->endpoint("getFile", $content);
	}
	
	public function downloadFile($telegram_file_path, $local_file_path) {
		$file_url = "https://api.telegram.org/file/bot" . $this->bot_id . "/" . $telegram_file_path;
		$in = fopen($file_url, "rb");
		$out = fopen($local_file_path, "wb");

		while ($chunk = fread($in, 8192)) {
			fwrite($out, $chunk, 8192);
		}
		fclose($in);
		fclose($out);
	}

	public function setWebhook($url, $certificate = "") {
		if ($certificate == "") {
			$content = array('url' => $url);
		} else {
			$content = array('url' => $url, 'certificate' => $certificate);
		}
		return $this->endpoint("setWebhook", $content);
	}

	public function getData() {
		if (empty($this->data)) {
			$rawData = file_get_contents("php://input");
			return json_decode($rawData, true);
		} else {
			return $this->data;
			print_r($this->data);
		}
	}
	
	public function setData(array $data) {
		$this->data = $data;
	}
	public function QueryText() {
		return $this->data["inline_query"]["query"];
	}
	public function QueryID() {
		return $this->data["inline_query"]["id"];
	}
	public function Text() {
		return $this->data["message"] ["text"];
	}
	public function MessageID() {
		return $this->data["message"]["message_id"];
	}
	public function ForwardID() {
		return $this->data["message"]["forward_from"]["id"];
	}
	public function ForwardFrom() {
		return $this->data["message"]["forward_from"]["username"];
	}
	public function ChatID() {
		return $this->data["message"]["chat"]["id"];
	}
	public function ReplyID() {
		if (isset($this->data["message"]["reply_to_message"]["message_id"]) == true) {
			return $this->data["message"]["reply_to_message"]["message_id"];
		}
		return null;
	}
	public function ReplyText() {
		if (isset($this->data["message"]["reply_to_message"]["text"]) == true) {
			return $this->data["message"]["reply_to_message"]["text"];
		}
		return null;
	}

	public function Callback_Query() {
		return $this->data["callback_query"];
	}

	public function Callback_ID() {
		return $this->data["callback_query"]["id"];
	}

	public function Callback_Data() {
		return $this->data["callback_query"]["data"];
	}

	public function Callback_Message() {
		return $this->data["callback_query"]["message"];
	}

	public function Callback_ChatID() {
	}

	public function Date() {
		return $this->data["message"]["date"];
	}

	public function FirstName() {
		return $this->data["message"]["from"]["first_name"];
	}

	public function LastName() {
		return $this->data["message"]["from"]["last_name"];
	}

	public function Username() {
		return $this->data["message"]["from"]["username"];
	}

	public function Location() {
		return $this->data["message"]["location"];
	}

	public function UpdateID() {
		return $this->data["update_id"];
	}

	public function UpdateCount() {
		return count($this->updates["result"]);
	}

	public function messageFromGroup() {
		if ($this->data["message"]["chat"]["title"] == "") {
			return false;
		}
		return true;
	}

	public function person() {
		if (isset($this->data["message"]["new_chat_participant"]["first_name"]) == true) {
			return 'new';
		} else if (isset($this->data["message"]["left_chat_participant"]["first_name"]) == true) {
			return 'left';
		}
		return false;
	}

	public function newphoto() {
		if (isset($this->data["message"]["new_chat_photo"]) == true) {
			return true;
		}
		return false;
	}
	
	public function personName() {
		if (isset($this->data["message"]["new_chat_participant"]["username"]) == true) {
			return '@' . $this->data["message"]["new_chat_participant"]["username"];
		} else if (isset($this->data["message"]["left_chat_participant"]["username"]) == true) {
			return '@' . $this->data["message"]["left_chat_participant"]["username"];
		}
		return null;
	}

	public function getUpdates($offset = 0, $limit = 100, $timeout = 0, $update = true) {
		$content = array('offset' => $offset, 'limit' => $limit, 'timeout' => $timeout);
		$this->updates = $this->endpoint("getUpdates", $content);
		if ($update) {
			if(count($this->updates["result"]) >= 1) { //for CLI working.
				$last_element_id = $this->updates["result"][count($this->updates["result"]) - 1]["update_id"] + 1;
				$content = array('offset' => $last_element_id, 'limit' => "1", 'timeout' => $timeout);
				$this->endpoint("getUpdates", $content);
			}
		}
		return $this->updates;
		print_r($this->updates);
	}

	public function serveUpdate($update) {
		$this->data = $this->updates["result"][$update];
	}

	private function sendAPIRequest($url, array $content, $post = true) {
		if (isset($content['chat_id'])) {
			$url = $url . "?chat_id=" . $content['chat_id'];
			unset($content['chat_id']);
		}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if ($post) {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
		}
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

}

// Helper for Uploading file using CURL
if (!function_exists('curl_file_create')) {

	function curl_file_create($filename, $mimetype = '', $postname = '') {
		return "@$filename;filename="
				. ($postname ? : basename($filename))
				. ($mimetype ? ";type=$mimetype" : '');
	}

}

function urbandictionary($word){
	$word = str_replace(' ','-',$word);
	$dom = new DomDocument;
	$dom->loadHTML(file_get_contents('http://urbandictionary.com/define.php?term=' . $word));
	$finder = new DomXPath($dom);
	$className = 'meaning';
	$definitionArray = $finder->query("//*[contains(@class, '$className')]");
	return $definitionArray->item(0)->nodeValue;
}

function markov($kok) {
	$files = glob('assets/markov/*');
	$message = $files[array_rand($files)];
	$chat = file_get_contents($message);
	return $chat;
}

function kopieerpasta($dir = 'assets/kopieerpasta') {
	$files = glob($dir . '/*.*');
	$file = array_rand($files);
	$kopieerpasta = file_get_contents($files[$file]);
	return $kopieerpasta;
}

function nsb($dir = 'assets/nsb') {
	$files = glob($dir . '/*.*');
	$file = array_rand($files);
	$nsb = new CURLFile($files[$file]);
	return $nsb;
}

function rms($dir = 'assets/rms') {
	$files = glob($dir . '/*.*');
	$file = array_rand($files);
	$rms = new CURLFile($files[$file]);
	return $rms;
}

function zeg($tekst, $taal) {
   $woorden =  substr($tekst, 0, 200);
   $words = urlencode($woorden);
   $file  = md5($words);
   $file = "assets/audio/" . $file . ".mp3";
   if (!file_exists($file)) {
	 $mp3 = file_get_contents('http://translate.google.com/translate_tts?ie=UTF-8&total=1&idx=0&textlen=32&client=tw-ob&q=' . $words . '&tl=' . $taal);
	 file_put_contents($file, $mp3);
   }
   return new CURLFile($file);
}

function oorporno() {
	$oorporno = array("http://www.youtube.com/watch?v=xdb-KNTBdqA",
					  "http://www.youtube.com/watch?v=hyB_VfrESNQ",
					  "http://www.youtube.com/watch?v=VSv0w8egCYE",
					  "http://www.youtube.com/watch?v=_U2HsdbbDgI");
	$count = count($oorporno) - 1;
	$random = rand(0, $count);
	return $oorporno[$random];
}

function contains($str, array $arr) {
	foreach($arr as $a) {
		if (stripos($str,$a) !== false) return true;
	}
	return false;
}

function reverse ($string, $encoding = null) {
	if ($encoding === null) {
		$encoding = mb_detect_encoding($string);
	}
	$length = mb_strlen($string, $encoding);
	$reversed = '';

	while ($length-- > 0) {
		$reversed .= mb_substr($string, $length, 1, $encoding);
	}

	return $reversed;
}

function draai($text){
	$tekst = strtolower(reverse($text));
	$text = strtolower($text);
	$chars = Array(
		'a' => 'ɐ',
		'b' => 'q',
		'c' => 'ɔ',
		'd' => 'p',
		'e' => 'ǝ',
		'f' => 'ɟ',
		'g' => 'ƃ',
		'h' => 'ɥ',
		'i' => 'ı',
		'j' => 'ɾ',
		'k' => 'ʞ',
		'l' => 'l',
		'm' => 'ɯ',
		'n' => 'u',
		'o' => 'o',
		'p' => 'd',
		'q' => 'b',
		'r' => 'ɹ',
		's' => 's',
		't' => 'ʇ',
		'u' => 'n',
		'v' => 'ʌ',
		'w' => 'ʍ',
		'x' => 'x',
		'y' => 'ʎ',
		'z' => 'z',
		'.' => '˙',
		',' => "'",
		"'" => ',',
		'?' => '¿',
		'!' => '¡',
	);
	
	if ($text == null) {
		return 'Ik het niet kunnen 😭😭😭';
	} else {
		$arr = Array('b', 'd', 'q', 'p', 'o', 's', 'x', 'u', 'n', 'z', 'l', "'");
		$gefilterd = str_replace($arr,'',$text);
		if (!contains($gefilterd, $chars)) {
			return strtr($tekst,$chars);
		} else {
			return reverse(strtr($text,array_flip($chars)));
		}
	}
}

function papgrap() {
	$result = null;
	$rss = new DOMDocument();
	$rss->load('https://www.reddit.com/r/papgrappen/new/.rss');
	$feed = array();
	foreach ($rss->getElementsByTagName('entry') as $node) {
		$item = array (
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'text' => $node->getElementsByTagName('content')->item(0)->nodeValue
		);
		array_push($feed, $item);
	}
	$rand = rand(0,24); 
	for ($x=0;$x<1;$x++) {
		$title = $feed[$rand]['title'];
		$text = $feed[$rand]['text'];
		$result .= '*'.$title.'*';
		$result .= PHP_EOL;
		$result .= PHP_EOL;
	
	$degrap = strstr($text, '</p> </div>', true);
	
		$result .= htmlspecialchars_decode(urldecode(strip_tags($degrap)));
	}
	return $result;
}

function meem() {
	$result = null;
	$rss = new DOMDocument();
	$rss->load('https://www.reddit.com/r/cirkeltrek/new/.rss');
	$feed = array();
	foreach ($rss->getElementsByTagName('entry') as $node) {
		$item = array (
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('content')->item(0)->nodeValue
		);
		array_push($feed, $item);
	}

	$rand = rand(0,24); 
	for ($x=0;$x<1;$x++) {
		$title = $feed[$rand]['title'];
		$link = strstr($feed[$rand]['link'], 'submitted');
		$result .= $title;
		$result .= PHP_EOL;
	
  $regex = '/https?\:\/\/[^\" ]+/i';
  preg_match_all($regex, $link, $matches);
	
		$result .= $matches[0][1];
	}
	return $result;
}

function feesboek() {
	$result = null;
	$rss = new DOMDocument();
	$rss->load('https://www.reddit.com/r/tokkiefeesboek/new/.rss');
	$feed = array();
	foreach ($rss->getElementsByTagName('entry') as $node) {
		$item = array (
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('content')->item(0)->nodeValue
		);
		array_push($feed, $item);
	}
	
	$rand = rand(0,24); 
	for ($x=0;$x<1;$x++) {
		$title = $feed[$rand]['title'];
		$link = strstr($feed[$rand]['link'], 'submitted');
		$result .= $title;
		$result .= PHP_EOL;
	
  $regex = '/https?\:\/\/[^\" ]+/i';
  preg_match_all($regex, $link, $matches);
	
		$result .= $matches[0][1];
	}
	return $result;
}

function ik_ihe() {
	$result = null;
	$rss = new DOMDocument();
	$rss->load('https://www.reddit.com/r/ik_ihe/new/.rss');
	$feed = array();
	foreach ($rss->getElementsByTagName('entry') as $node) {
		$item = array (
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('content')->item(0)->nodeValue
		);
		array_push($feed, $item);
	}
	
	$rand = rand(0,24); 
	for ($x=0;$x<1;$x++) {
		$title = $feed[$rand]['title'];
		$link = strstr($feed[$rand]['link'], 'submitted');
		$result .= $title;
		$result .= PHP_EOL;
	
	$regex = '/https?\:\/\/[^\" ]+/i';
	preg_match_all($regex, $link, $matches);
	
		$result .= $matches[0][1];
	}
	return $result;
}
?>
