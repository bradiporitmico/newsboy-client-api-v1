<?php

namespace Newsboy\Client\v1;

class Api{

	static $classes = [];
	static $calls = [];
	static $total_time = 0;
	var $request_id;


	/**
	 * Token di connessione
	 *
	 * @var        string
	 */
	private $token = null;


	/**
	 * Oggetto curl
	 *
	 * @var        handle
	 */
	static $curl = null;


	/**
	 * Base url per le chiamate REST alla API
	 *
	 * @var        string
	 */
	private $base_url = '';

	/**
	 * Imposta il base url al valore predefinito (necessario per fare la login)
	 */
	public function resetBaseUrl(){
		$this->base_url = 'https://api.newsboy.it/';
	}


	/**
	 * Effettua una chiamata alle API degli annunci
	 * 
	 *
	 * @param      string   $path       Il percorso della chiamata
	 * @param      mixed 	  $json_post  Una stringa o un oggetto o array associativo che verrà passato come body nella chiamata
	 * @param      string   $method  		Un valore stringa che verrà utilizzato come metodo di chiamata ("GET" | "HEAD" | "POST" | "PUT" | "DELETE" | "CONNECT" | "OPTIONS" | "TRACE" | "PATCH").
	 * 																	Se non specificato verrà utilizzato il metodo "GET" oppure il metodo "POST" in presenza di valori nel parametro $post
	 *
	 * @api
	 * @throws     NullResponseException  In caso di risposta nulla dal server
	 * @throws     CorruptedResponseException  Nel caso in cui non sia possibile decodificare il json ritornato perché corrotto
	 *
	 * @return     Object     Un oggetto derivante dal json ritornato
	 */
	public function call (string $path, $post = null, $method=null){
		$time = microtime(true);
		// if (!$this->curl){
		// 	$this->curl = curl_init();
		// }
		$this->url = "{$this->base_url}{$path}";
		// \Nicer::print_r ([
		// 	'url'=>$this->url,
		// 	'post'=>$post,
		// 	'method'=>$method ? : 'GET',
		// ], 'API::call');

		// self::$curl = curl_init();
		
		curl_setopt(self::$curl, CURLOPT_URL, $this->url);
		if ($this->token){
			curl_setopt(self::$curl, CURLOPT_HTTPHEADER, ["Authorization: bearer {$this->token}"]);
		}

		if ($post){
			curl_setopt(self::$curl, CURLOPT_POST, true); 
			curl_setopt(self::$curl, CURLOPT_POSTFIELDS, $post);
		}
		if ($method){
			curl_setopt(self::$curl, CURLOPT_CUSTOMREQUEST, $method);
		}
		curl_setopt(self::$curl, CURLOPT_RETURNTRANSFER, true);
		$res = curl_exec(self::$curl);
		// curl_close(self::$curl);
		curl_reset(self::$curl);
		// \Nicer::print_r ($res, 'API::call - result as string');
		// pre_print_r ($res);

		$dtime = (microtime(true) - $time) * 1000;
		// $dbg = debug_backtrace();
		// self::$calls [] = [
		// 	'url' => "[".($method ? : 'GET')."] ".$this->url,
		// 	'function' => $dbg[3]['function'],
		// 	'file' => "{$dbg[3]['file']}:{$dbg[3]['line']}",
		// 	'time' => $dtime,
		// ];
		self::$total_time += $dtime;

		if (!$res){
			throw new NullResponseException("Empty response");
		}

		$json = json_decode($res);
		if (!$json){
			throw new CorruptedResponseException("Unable to parse json [$res]");
		}
		// \Nicer::print_r ($json, 'API::call - result as json');

		if (!$json->success){
			throw (new FailedCallException($json->errorMessage))->setExceptionType($json->errorType)->setJson ($json);
		}

		$this->request_id = (string)$json->requestID;
		return $json;
	}


	/**
	 * Get the value of request_id
	 */ 
	public function getRequestId(){
		return $this->request_id;
	}

	/**
	 * Ritorna il token di connessione
	 *
	 * @api
	 * @return     string  Il token.
	 */
	public function getToken () : string{
		return $this->token;
	}

	/**
	 * Imposta il token
	 *
	 * @param      string    $token  Il token
	 * @api
	 * @return     Api|self  Istanza della Api
	 */
	public function setToken (string $token) : Api{
		$this->token = $token;
		return $this;
	}

	/**
	 * Torna il base url per le chiamate REST
	 *
	 * @api
	 * @return     string  Il base url.
	 */
	public function getBaseUrl () :string{
		return $this->base_url;
	}

	/**
	 * Imposta il base url per le chiamate REST
	 *
	 * @api
	 * @param      string    $value  Il valore del baseurl da impostare
	 * @return     Api|self  Istanza della Api
	 */
	public function setBaseUrl (string $value) : Api{
		$this->base_url = $value;
		return $this;
	}

	/**
	 * Torna l'url dell'ultima chiamata effettuata
	 *
	 * @api
	 * @return     string    $value  L'url dell'ultima chiamata effettuata
	 */
	public function getURL (){
		return $this->url;
	}

	/**
	 * Esegue il login sul servizio REST
	 *
	 * @api
	 * @param      string  $username  La username dell'utente
	 * @param      string  $password  La password dell'utente
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 *
	 */
	public function login (string $username, string $password, string $scope = null){
		$this->resetBaseUrl();
		$res = $this->call('login', ['username'=>$username, 'password'=>$password, 'scope'=>$scope]);
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}

		$this->setBaseUrl ($res->response->endpoint);
		$this->setToken ($res->response->token);
		return $res->response;
	}


	public function getClassInstance(string $name){
		if (!isset (self::$classes[$name])){
			self::$classes[$name] = new $name($this);
		}
		return self::$classes[$name];
	}
	
	// public function getCategoryInstance(){
	// 	if (!self::$classes[Category::class]){
	// 		self::$classes[Category::class] = new Category ($this);
	// 	}
	// 	return self::$classes[Category::class];
	// }
	
	// public function getFinderInstance(){
	// 	if (!self::$filter_class){
	// 		self::$filter_class = new Filter ($this);
	// 	}
	// 	return self::$filter_class;
	// }
	


	/**
	 * Torna un elenco di risultati di zone,comuni,province in base al termine specificato.
	 *
	 * @param      string  $term   Il termine da cercare.
	 *
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */
	public function searchWhere(string $term){
		$res = $this->call ("ads/search/where/".urlencode($term));
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}
		return $res->response;
	}

	/**
	 * Torna un elenco di risultati di zone,comuni,province in base al termine specificato.
	 * Questa versione utilizza il sistema dei filtri
	 *
	 * @param      string  $term   Il termine da cercare
	 * @param      string  $filter Il filtro da utilizzare
	 *
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */
	public function searchWhereFiltered(string $filter, string $term){
		$res = $this->call ("post/where/{$filter}/".urlencode($term));
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}
		return $res->response;
	}

	/**
	 * Ritorna le informazioni di un comune
	 *
	 * @param      string  $id     Id del comune
	 *
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */
	public function comuneInfo(string $id){
		$res = $this->call ("ads/municipality/".urlencode($id));
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}
		return $res->response;
	}


	/**
	 * Torna le informazione di una provincia
	 *
	 * @param      string  $id     The identifier
	 *
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */
	public function provinciaInfo(string $id){
		$res = $this->call ("ads/province/".urlencode($id));
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}
		return $res->response;
	}


	/**
	 * Crea un blob.
	 * La creazione di un blob non implica l'immediato upload del suo contenuto.
	 * Successivamente alla creazione sarà possibile chiamare il methodo blobUpload per 
	 * effettuare l'effettivo uploade dei dati
	 *
	 * @param      <type>  $post   The post
	 *
	 * @api
	 * @throws     FailedCallException  Nel caso in cui il server REST abbia risposto con un errore. L'eccezione conterrà il messaggio di errore prodotto dal server
	 * @return     mixed  La risposta ricevuta dal server
	 */
	public function blobCreate(){
		$res = $this->call ("blob/create", null, 'POST');
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}
		return $res->response;
	}

	public function blobUpload(string $id, string $filename, string $mime){
		$res = $this->call ("blob/".urlencode($id), [
			'content' => new \CURLFile($filename, $mime, basename($filename))
		]);
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}
		return $res->response;
	}

	
	public function getPropertyAdmittedValues(string $property){
		$res = $this->call ("ads/property/{$property}/admitted-values");
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}
		return $res->response;
	} 

	public function getPropertiesList(string $category){
		$res = $this->call ("ads/properties/{$category}");
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}
		return $res->response;
	} 

	public function getOptionsList(string $category){ 
		$res = $this->call ("ads/options/{$category}");
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}
		return $res->response;
	}
	
	/**
	 * ADDRESS
	 * ------------------
	 */

	public function municipalitySimpleList(){
		$res = $this->call ("address/municipality/enum");
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}
		return $res->response;
	}

	/**
	 * Clear posts cache
	 */
	public function flushCache(){
		$res = $this->call ("post/cache/flush");
		if (!$res->success){
			throw (new FailedCallException($res->errorMessage))->setExceptionType($res->errorType);
		}
		return $res->response;
	}


	/**
	 * version
	 * ------------------
	 */

	public function version(){
		$res = $this->call ("info");
		return $res->response;
	}



}

API::$curl = curl_init();
