<?php

namespace Newsboy\Client\v1;

class Category{
	private $api = null;

	public function __construct (Api $api){
		$this->api = $api;
	}

	/**
	 * Torna l'elenco delle sotto categorie o sottocategorie
	 *
	 * @api
	 * @param      string  $parent  La categoria padre. Null per ottenere l'elenco di categorie principali
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     object  The categories.
	 */

	public function list($parent = null){
		if ($parent){
			$res = $this->api->call ("ads/subcategories/".urlencode($parent));
		}else{
			$res = $this->api->call ("ads/categories");
		}
		return $res->response;
	}
}
