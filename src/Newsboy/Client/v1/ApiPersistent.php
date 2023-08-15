<?php

namespace Newsboy\Client\v1;
 
class ApiPersistent extends Api{

	private $username;
	static $cached_call = null;
	static $calls = [];


	private function getPersistentLoginData(){
		// return  \lib\Session::get(self::class."\Login");
		return  $_SESSION[self::class."\Login"] ?? false;
	}
	
	private function clearPersistentLoginData(){
		unset ($_SESSION[self::class."\Login"]);
		// return  \lib\Session::unset(self::class."\Login");
	}
	
	private function setPersistentLoginData($data){
		$_SESSION[self::class."\Login"] = $data;
		// \lib\Session::set(self::class."\Login", $data);
	}
	
	public function logout (){
		$this->clearPersistentLoginData();
	}

	public function login (string $username, string $password, string $scope = null){
		$persistent = $this->getPersistentLoginData();
		// pre_print_ru ($persistent);
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
		// $method = $method ? : 'GET';
		$post_data = $post ? md5 (json_encode ($post)) : '';
		// if ($post && (!$method)) {
		// 	$method = 'POST';
		// }
		// $method = $method ? : ($post ? 'POST' : 'GET');
		$cache_key = "{$method} {$path}{$post_data}";
		// pre_print_ru ($cache_key); die;
		self::$calls [] = "[{$method}] ".$path;
		try{
			if (!(self::$cached_call[$cache_key] ?? false)){
				// chiamo la call originale e attendo esplosione o esito corretto
				self::$cached_call[$cache_key] = parent::call($path, $post, $method);
			}
			return self::$cached_call[$cache_key];
		}catch (FailedCallException $e){
			// controllo se è esplosa per via del token scaduto
			$json = $e->getJson();
			// pre_print_ru ($json); die;
			// print_r ($json); 
			// print_r ($e); die;
			if (!$json || $json->errorType == 'Firebase\JWT\ExpiredException'){
				// rifaccio il login vero e aggiorno i dati persistenti
				$p = $this->getPersistentLoginData();
				$this->clearPersistentLoginData();
				$this->login($p['username'], $p['password']);

				// rifaccio la chiamata
				return parent::call($path, $post, $method);
			} else {
				throw $e;
			}
		}
	}

	

}