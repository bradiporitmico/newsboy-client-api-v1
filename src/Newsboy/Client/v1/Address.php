<?php

namespace Newsboy\Client\v1;

class Address{

	private $api = null;

	public function __construct (Api $api){
		$this->api = $api;
	}

	/**
	 * Cerca fra i comuni partendo dal nome
	 *
	 * @param string $term Il test da cercare fra i nomi di comuni
	 */
	public function municipalitySearch(string $term){
		$res = $this->api->call ("address/search/municipality/".urlencode($term));
		return $res->response;
	}


	/**
	 * Torna le info di un comune (o di tutti i comuni)
	 *
	 * @param string $id L'id (slug) del comune. Se non specificato verrà tornata la lista completa di tutti i comuni
	 */
	public function municipality(string $id = ''){
		$id = $id ? "/{$id}" : '';
		$res = $this->api->call ("address/municipality{$id}");
		return $res->response;
	}


	/**
	 * Torna le info di una provincia
	 *
	 * @param string $id L'id (slug) della provincia. Se non specificato verrà tornata la lista completa di tutte le province
	 */
	public function province(string $id = ''){
		$id = $id ? "/{$id}" : '';
		$res = $this->api->call ("address/province{$id}");
		return $res->response;
	}


}

