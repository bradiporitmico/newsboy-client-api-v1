<?php

namespace Newsboy\Client\v1;
 
class ApiPersistent extends Api{

	private $username;
	static $cached_call = null;
	static $calls = [];


	private function getPersistentLoginData(){
		return  \Session::get(self::class."\Login");
	}
	
	private function clearPersistentLoginData(){
		return  \Session::unset(self::class."\Login");
	}
	
	private function setPersistentLoginData($data){
		\Session::set(self::class."\Login", $data);
	}
	
	public function logout (){
		$this->clearPersistentLoginData();
	}

	public function login (string $username, string $password, string $scope = null){
		$persistent = $this->getPersistentLoginData();
		if (!$persistent || ($persistent['username'] != $username)){
			parent::login ($username, $password, $scope);
			$this->setPersistentLoginData ([
				'baseurl' => $this->getBaseUrl(),
				'token' => $this->getToken(),
				'username' => $username,
				'password' => $password,
				'scope' => $scope,
			]);
			$persistent = $this->getPersistentLoginData();
		}

		if (!$persistent['baseurl'] ?? false){
			$this->logout ();
			return false;
		}

		$this->setBaseUrl ($persistent['baseurl']);
		$this->setToken ($persistent['token']);
		return true;

	}

	/** @override **/
	public function call (string $path, $post = null, $method=null){
		self::$calls [] = "[".($method ? : 'GET')."] ".$path;
		try{
			if (!(self::$cached_call[$path] ?? false)){
				// chiamo la call originale e attendo esplosione o esito corretto
				self::$cached_call[$path] = parent::call($path, $post, $method);
			}
			return self::$cached_call[$path];
		}catch (FailedCallException $e){
			// controllo se è esplosa per via del token scaduto
			$json = $e->getJson();
			// print_r ($json); 
			// print_r ($e); die;
			if (!$json || $json->errorType == 'Firebase\JWT\ExpiredException'){
				// rifaccio il login vero e aggiorno i dati persistenti
				$p = $this->getPersistentLoginData();
				$this->clearPersistentLoginData();
				$this->login($p['username'], $p['password']);

				// rifaccio la chiamata
				return parent::call($path, $post, $method);
			}
		}
	}

	

}