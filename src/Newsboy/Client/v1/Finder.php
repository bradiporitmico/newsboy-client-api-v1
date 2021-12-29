<?php

namespace Newsboy\Client\v1;



class Finder{

	private $api = null;

	public function __construct (Api $api){
		$this->api = $api;
	}


	public function find(string $filter_name, int $page = 0, $filters = null){
		$res = $this->api->call ("post/find/{$filter_name}/{$page}", json_encode($filters), 'POST');
		return $res->response;
	}



}

