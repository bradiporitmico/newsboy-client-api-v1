<?php

namespace Newsboy\Client\v1;

class Dashboard{
	private $api = null;

	public function __construct (Api $api){
		$this->api = $api;
	}

	/**
	 * Torna l'elenco degli annunci di un particolare utente
	 *
	 * @api
	 * @param      int  $user_id  L'id del webuser
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     object  Elenco di annunci
	 */

	public function list($user_id = 0){
		$res = $this->api->call ("dashboard/user/list/".urlencode($user_id),null,'POST');
		return $res->response;
	}
}
