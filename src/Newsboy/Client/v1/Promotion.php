<?php

namespace Newsboy\Client\v1;

class Promotion{

	private $api = null;

	public function __construct (Api $api){
		$this->api = $api;
	}

	/**
	 * Torna le info sulla promozione
	 *
	 * @param string $uuid Id dell'annuncio
	 * @return object L'oggetto della promozione
	 */
	public function info(string $uuid){
		$res = $this->api->call ("promotion/".urlencode ($uuid));
		return $res->response;
	}

	/**
	 * Imposta il tipo di promozione
	 *
	 * @param string $uuid Id dell'annuncio
	 * @param string $type Tipo di promozione ('gratis', 'bronze', 'silver', 'gold')
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */
	public function setType(string $uuid, string $type){
		$res = $this->api->call ("promotion/{$uuid}/type/{$type}", null, 'POST');
		return $res->response;
	}

	public function setDate(string $uuid, \DateTime $date){
		$res = $this->api->call ("promotion/{$uuid}/date/".urlencode($date->format ('Y-m-d H:i:s')), null, 'POST');
		return $res->response;
	}

	/**
	 * Aggiorna i dati della promozione
	 *
	 * @param string $uuid L'uuid dell'annuncio
	 * @param string $type Il tipo di promozione  ('gratis', 'bronze', 'silver', 'gold')
	 * @param \DateTime $date La data di partenza della promozione
	 * @param integer $duration La durata (in secondi) della promozione
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */
	public function update(string $uuid, string $type, \DateTime $date, int $duration){
		$data = [
			'type' => $type,
			'duration' => $duration,
			'date' => $date->format ('Y-m-d H:i:s'),
		];
		$res = $this->api->call ("promotion/".urlencode($uuid), json_encode ($data), 'POST');
		return $res->response;
	}



}

