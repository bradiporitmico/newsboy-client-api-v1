<?php

namespace Newsboy\Client\v1;
 
class Similar {
	private $api = null;

	public function __construct (Api $api){
		$this->api = $api;
	}

	/**
	 * Torna l'elenco di annunci simili
	 *
	 * @api
	 * @param      string  $uuid  L'uuid dell'annuncio
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     object  Un array di annunci simili
	 */

	 public function get(string $uuid){
		$res = $this->api->call ("ads/similar/{$uuid}");
		return $res->response;
	}

}

