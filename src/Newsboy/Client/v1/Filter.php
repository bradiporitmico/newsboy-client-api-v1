<?php

namespace Newsboy\Client\v1;

class Filter{
	private $api = null;

	public function __construct (Api $api){
		$this->api = $api;
	}

	public function generateTable(string $filter_name){
		$res = $this->api->call ("/post/filter/generate/{$filter_name}");
		return $res->response;
	}

	public function duplicate(string $source_id){
		$res = $this->api->call ("post/filter/duplicate/{$source_id}");
	}

	public function fullList(){
		$res = $this->api->call ("post/filter/fulllist");
		return $res->response;
	}

	public function list(string $parent = null){
		if ($parent)
			$res = $this->api->call ("post/filter/list/{$parent}");
		else
			$res = $this->api->call ("post/filter/list");
		return $res->response;
	}

	public function tree(string $parent = null){
		$res = $this->api->call ("post/filter/tree/{$parent}");
		return $res->response;
	}

	public function info(string $filter_name){
		$res = $this->api->call ("post/filter/info/{$filter_name}");
		return $res->response;
	}

	public function statsMunicipality(string $filter_name){
		$res = $this->api->call ("post/filter/{$filter_name}/stats/municipality");
		return $res->response;
	}


}
