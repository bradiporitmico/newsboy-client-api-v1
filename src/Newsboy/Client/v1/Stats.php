<?php

namespace Newsboy\Client\v1;

class Stats{

	private $api = null;

	public function __construct (Api $api){
		$this->api = $api;
	}

	public function origins(){
		return $this->api->call ("ads/stats/origin")->response;
	}



}

