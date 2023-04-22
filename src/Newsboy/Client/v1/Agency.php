<?php

namespace Newsboy\Client\v1;

class Agency{

	private $api = null;

	public function __construct (Api $api){
		$this->api = $api;
	}

	public function info(string $uuid){
		$res = $this->api->call ("agency/info/{$uuid}");
		return $res->response;
	}

	/**
	 * Torna l'elenco di agenzie dell'utente loggato
	 *
	 * @return void
	 */
	public function list(){
		$res = $this->api->call ("agency/list");
		return $res->response;
	}

	/**
	 * Torna l'elenco completo delle agenzie
	 * Solo l'utente root può chiamare questo metodo
	 *
	 * @return void
	 */
	public function fulllist(){
		$res = $this->api->call ("agency/fulllist");
		return $res->response;
	}

	public function getId(string $code){
		$res = $this->api->call ("agency/getid/{$code}");
		return $res->response;
	}

	public function getIdByEmail(string $mail){
		$res = $this->api->call ("agency/getidbyemail/{$mail}");
		return $res->response;
	}

	public function create(string $code){
		$res = $this->api->call ("agency/create/{$code}", null, 'POST');
		return $res->response;
	}

	public function update(string $code, $options = []){
		$res = $this->api->call ("agency/update/{$code}", json_encode ($options), 'PUT');
		return $res->response;
	}



}

