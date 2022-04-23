<?php

namespace Newsboy\Client\v1;

class Address{

	private $api = null;

	public function __construct (Api $api){
		$this->api = $api;
	}

	public function municipalitySearch(string $term){
		$res = $this->api->call ("address/search/municipality/".urlencode($term));
		return $res->response;
	}



}

