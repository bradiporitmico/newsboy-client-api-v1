<?php

namespace Newsboy\Client\v1;
 
class Meta {
	private $api = null;

	public function __construct (Api $api){
		$this->api = $api;
	}

	/**
	 * Torna le meta info dell'annuncio
	 *
	 * @api
	 * @param      string  $uuid  L'uuid dell'annuncio
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     object  Tutte le metainfo disponibili per questo annuncio
	 */

	 public function get(string $uuid){
		$res = $this->api->call ("ads/meta/{$uuid}");
		return $res->response;
	}

}

