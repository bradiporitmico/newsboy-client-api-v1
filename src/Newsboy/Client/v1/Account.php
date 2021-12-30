<?php

namespace Newsboy\Client\v1;

class Account{

	private $api = null;

	public function __construct (Api $api){
		$this->api = $api;
	}

	public function info(string $scope, string $user_id = ''){
		$res = $this->api->call ("account/info/{$scope}/{$user_id}");
		return $res->response;
	}



}

