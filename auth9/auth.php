<?
require('authConfig.php');
require('HttpClient.class.php');

class Auth9{
	private $clientID;
	private $appSecret;

	function __construct($id,$secret){
		$this->clientID=$id;
		$this->appSecret=$secret;
	}

	public function getAuthURL($callback_url){
		return AUTH_URL.'?client_id='.$this->clientID.'&redirect_uri='.$this->fixURL($callback_url);
	}

	public function getAccessToken($code,$callback){// it should be post, but I just juse get for temp use
		$url=ACCESS_TOKEN_URL.'?client_id='.$this->clientID.'&client_secret='.$this->appSecret.'&redirect_uri='.$this->fixURL($callback).'&code='.$code;
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$res=curl_exec($ch);
		curl_close($ch);
		return json_decode($res,true);

		$url=ACCESS_TOKEN_URL.'?client_id='.$this->clientID.'&client_secret='.$this->appSecret.'&redirect_uri='.$this->fixURL($callback).'&code='.$code;
		return HttpClient::quickPost(ACCESS_TOKEN_URL,array(
			'client_id'=>$this->clientID,
			'client_secret'=>$this->appSecret,
			'redirect_uri'=>$this->fixURL($callback),
			'code'=>$code
			));
	}

	private function fixURL($url){
		if(strrchr($url,'/')==false)$url='http://'.$_SERVER['SERVER_NAME'].'/'.$url;
		return $url;
	}
}
?>
