<?php

namespace Newsboy\Client\v1;
 
class Ad {
	private $api = null;

	public function __construct (Api $api){
		$this->api = $api;
	}

	/**
	 * Recupera le informazioni di un annuncio
	 *
	 * @param      string  $id     	ID dell'annuncio 
	 * @param      object  $options Una serie di opzioni da passare alla richiesta
	 * Le opzioni sono un array di array associativo espressi in questa forma:
	 * [
	 * 	"wanted":[ 
	 * 		"nome_del_campo", "nome_del_campo", "nome_del_campo" 
	 * 	]
	 * ]
	 *
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */

	public function info(string $id, $options = null){
		$res = $this->api->call ("ads/get/{$id}", json_encode($options), 'POST');
		return $res->response;
	}	


}


