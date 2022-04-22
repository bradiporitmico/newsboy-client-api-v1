<?php

namespace Newsboy\Client\v1;

class Agency{

	private $api = null;

	public function __construct (Api $api){
		$this->api = $api;
	}

	public function info(string $code){
		$res = $this->api->call ("/agency/info/{$code}");
		return $res->response;
	}

	public function create(string $code){
		$res = $this->api->call ("/agency/create/{$code}", null, 'POST');
		return $res->response;
	}

	public function update(string $code, $options = []){
		$res = $this->api->call ("/agency/update/{$code}", json_encode ($options), 'PUT');
		return $res->response;
	}



}

