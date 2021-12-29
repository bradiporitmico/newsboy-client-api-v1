<?php

namespace Newsboy\Client\v1;

class FailedCallException extends \Exception{
	private $exception_type;
	private $json;

	public function setExceptionType(string $s){
		$this->exception_type = $s;
		return $this;
	}

	public function getExceptionType(){
		return $this->exception_type;
	}

	public function setJson($json){
		$this->json = $json;
		return $this;
	}

	public function getJson(){
		return $this->json;
	}

}
 
