<?php

namespace Newsboy\Client\v1;
 
class Ad {
	private $api = null;

	public function __construct (Api $api){
		$this->api = $api;
	}
	/**
	 * Crea un annuncio
	 * 
 	 * @param      array  $properties     Un elenco di proprietà dell'annuncio.
	 * Le proprietà sono un elenco di chiave => valore, dove la chiave è il nome della
	 * proprietà e valore è il valore della proprietà.
	 * Ad esempio:
	 * 	$properties = [
	 * 		'address' => 'Via Milano, 13',
	 * 		'city' => 'Firenze',
	 * 		 .....
	 * 	]
	 * 
	 *
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */
	public function create($data){
		$res = $this->api->call ("ads/create", json_encode($data));
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}
		return $res->response;
	}

	/**
	 * Aggiorna le proprietà di un annuncio
	 * L'operazione di aggiornamento di un annuncio creerà una nuova versione dell'annuncio
	 * E' possibile recuperare una determinata versione dell'annuncio chiamando la funzione $this->info()
	 * 
	 * @param      string  $id     L'id dell'annuncio
 	 * @param      array  $properties     Un elenco di proprietà dell'annuncio.
	 * Per l'elenco delle proprietà e la loro funzione fare guardare la create
	 *
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */
	public function update(string $id, $properties){
		$datas = [
			'fields' => $properties
		];
		$res = $this->api->call ("ads/ad/".urlencode($id), json_encode($datas), 'PUT');
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}
		return $res->response;
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
	 * @param      int  $version     	La versione specifica di un annuncio, se non specificato viene riportata l'info dell'ultima versione disponibile per l'annuncio
	 *
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */

	public function info(string $id, $options = null, int $version = 0){
		$res = $this->api->call ("ads/get/{$id}".($version ? "/{$version}" : ''), json_encode($options), 'POST');
		return $res->response;
	}	

	/**
	 * Elimina un annuncio
	 *
	 * @param      string  $id     L'id dell'annuncio
	 *
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */
	public function delete(string $id){
		$res = $this->api->call ("ads/ad/".urlencode($id), null, 'DELETE');
		return $res->response;
	}	



	/**
	 * Elimina tutti gli annunci dell'utente loggato
	 *
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */
	public function deleteAll(){
		$res = $this->api->call ("ads/ad/all", null, 'DELETE');
		return $res->response;
	}


	/**
	 * Elimina tutti gli annunci dell'utente specificato
	 *
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */
	public function deleteAllUser($user){
		$res = $this->api->call ("post/user/{$user}", null, 'DELETE');
		return $res->response;
	}

	/**
	 * Segna come "pubblicato" un annuncio
	 *
	 * @param      string  $id     l'id dell'annuncio
	 *
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */
	public function publish(string $id){
		$res = $this->api->call ("ads/publish/".urlencode($id));
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}
		return $res->response;
	}

	/**
	 * Segna come "spubblicato" un annuncio
	 *
	 * @param      string  $id     l'id dell'annuncio
	 *
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */
	public function unpublish(string $id){
		$res = $this->api->call ("ads/unpublish/".urlencode($id));
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}
		return $res->response;
	}

	/**
	 * Segna come "approvato" una versione di un annuncio
	 *
	 * @param      string  $id     l'id dell'annuncio
	 * @param      int  $version     la versione dell'annuncio
	 *
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */
	public function approve(string $id, int $version){
		$res = $this->api->call ("ads/approve/".urlencode($id)."/{$version}");
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}
		return $res->response;
	}

	/**
	 * Segna come "approvato" tutte le versioni in attesa di approvazione
	 *
	 * @param      string  $id     l'id dell'annuncio
	 *
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */
	public function approveAllPendings(string $id){
		$res = $this->api->call ("ads/approve/".urlencode($id)."/all");
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}
		return $res->response;
	}

	/**
	 * Toglie l' "approvazione" ad una versione di un annuncio
	 *
	 * @param      string  $id     l'id dell'annuncio
	 * @param      int  $version     la versione dell'annuncio
	 *
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */
	public function unapprove(string $id, int $version, string $reason = null){
		$res = $this->api->call ("ads/unapprove/".urlencode($id)."/{$version}");
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}
		return $res->response;
	}




}


