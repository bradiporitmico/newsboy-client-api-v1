<?php

namespace Newsboy\Client\v1;

class Navigator extends Finder{

	private $filters = null;
	private $filter_name = null;
	private $page = 0;
	private $per_page = 0;
	private $total_items = 0;
	private $data = null;
	private $pages = [];

	public function __construct (Api $api){
		parent::__construct($api);
		$this->data = new \DataBusPersistent();
		$this->data->channel (self::class);
		// \Nicer::print_r ($this->data->all(), 'databus');

		$this->total_pages = (int)$this->data->get ('total_pages');
		$this->setPage ((int)$this->data->get ('page'));
		$this->pages = $this->data->get ('pages');
		$this->setOffset ((int)$this->data->get ('offset'));
		$this->setFilter($this->data->get ('filters'));
		$this->setFilterName($this->data->get ('filter_name'));
		$this->per_page = (int)$this->data->get ('per_page');
		$this->total_items = (int)$this->data->get ('total_items');
	}


	/**
	 * Torna il nome del filtro attualmente utilizzato
	 * @return  string il nome del filtro
	 */ 
	public function getFilter(){
		return $this->filter;
	}

	/**
	 * Imposta il filtro
	 *
	 * @return  self
	 */ 
	public function setFilter ($filter){
		$this->filter = $filter;
		return $this;
	}

	public function setOffset(int $value){
		$this->offset = $value;
		return $this;
	}

	public function getOffset(){
		return $this->offset;
	}

	/**
	 * Get the value of page
	 * @return  int Il numero di pagina attualmente impostato
	 */ 
	public function getPage(){
		return $this->page;
	}

	/**
	 * Imposta il numero di pagina
	 *
	 * @return  self
	 */ 
	public function setPage(int $page){
		$this->page = $page;
		return $this;
	}

	/**
	 * Get the value of filters
	 */ 
	public function getFilters(){
		return $this->filters;
	}

	/**
	 * Set the value of filters
	 *
	 * @return  self
	 */ 
	public function setFilters($filters){
		$this->filters = $filters;
		return $this;
	}

	/**
	 * Get the value of filter_name
	 */ 
	public function getFilterName()
	{
		return $this->filter_name;
	}

	/**
	 * Set the value of filter_name
	 *
	 * @return  self
	 */ 
	public function setFilterName($filter_name){
		$this->filter_name = $filter_name;
		return $this;
	}	

	/**
	 * Elenca gli annunci
	 *
	 * @param string $filter_name Il nome del filtro 
	 * @param integer $page Il numero di pagina
	 * @param [type] $filters opzioni
	 * @return void
	 */
	public function find(string $filter_name, int $page = 0, $filters = null){

		$this->setFilterName ($filter_name);
		$this->setFilter ($filters);
		$this->setPage ($page);

		$this->pages = [];
		$res = $this->loadPage($page);
		// \Nicer::print_r ($res, 'navigator find');


		$this->per_page = $res->per_page;
		$this->total_items = $res->total_items;
		$this->total_pages = (int)ceil ($res->total_items / $res->per_page);
		$this->setOffset ($page * $this->per_page);

		$this->data->clear();
		$this->data->set ('total_pages', $this->total_pages);
		$this->data->set ('total_items', $this->total_items);
		$this->data->set ('filters', $this->getFilter());
		$this->data->set ('filter_name', $this->getFilterName());
		$this->data->set ('pages', $this->pages);
		$this->data->set ('per_page', $this->per_page);
		$this->data->set ('offset', $this->getOffset());
		return $res;
	}

	

	/**
	 * Trova l'offset dell'annuncio
	 * Il conteggio parte sempre dalla pagina 0
	 *
	 * @param string $uuid Id dell'annuncio per cui calcolare l'offset
	 * @return int 
	 */
	public function seekTo(string $uuid){
		for ($page_idx = 0; $page_idx < $this->total_pages; $page_idx++){
			if (isset ($this->pages[$page_idx])){
				foreach ($this->pages[$page_idx] as $idx => $item){
					if ($item->id == $uuid){
						$this->setOffset ($page_idx * $this->per_page + $idx);
						return $this->getOffset();
					}
				}
			}
		}
		throw new \Exception ("Navigator: unable to find uuid '$uuid'");
	}

	/**
	 * Carica i dati della pagina specificata
	 * Se i dati sono già stati caricati non fa nulla
	 *
	 * @param integer $page
	 * @return void
	 */
	private function loadPage(int $page){
		if (isset ($this->pages [$page])){
			return null;
		}
		$res = parent::find($this->getFilterName(), $page, $this->getFilter());
		$this->pages [$page] = $res->items ?? [];
		// \Nicer::print_r ($this->pages,'$this->pages');
		$this->data->set ('pages', $this->pages);

		return $res;
	}

	public function nextItem(){
		if ($this->getOffset() >= $this->total_items - 1){
			return null;
		}
		$new_ofs = $this->getOffset() + 1;
		$page_index = (int)($new_ofs / $this->per_page);
		$this->loadPage ($page_index);
		return $this->pages [$page_index][$new_ofs % $this->per_page];
	}

	public function previousItem(){
		if ($this->getOffset() <= 0){
			return null;
		}
		$new_ofs = $this->getOffset() - 1;
		$page_index = (int)($new_ofs / $this->per_page);
		$this->loadPage ($page_index);
		return $this->pages [$page_index][$new_ofs % $this->per_page];
	}

	/**
	 * Get the value of total_items
	 */ 
	public function getTotalItems(){
		return $this->total_items;
	}

}