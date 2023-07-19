<?php

namespace Newsboy\Client\v1;
 
class AdHelper implements \ArrayAccess{
	private $fields;

	public function __construct($ad = null){
		$this->fields = $ad->fields ?? $ad;
	}

	public function hasOption (string $option){
		return in_array ($option, $this->fields->options ?? []);
	}

	/** ArrayAccess implementations */
  public function offsetSet($offset, $value) {
  	$this->fields->$offset = $value;
  }

  public function offsetExists($offset) {
  	return isset($this->fields->$offset);
  }

	public function offsetUnset($offset) {
  	unset($this->fields->$offset);
  }
	
	public function offsetGet($offset) {
  	return $this->fields->$offset ?? null;
  }

	public function getImages ($type = 'detail'){
		if ($this->fields->assets->photo ?? false){
			$images = [];
			foreach ($this->fields->assets->photo as $photo){
				$images [] = $photo->$type->url ?? null;
			}
			return $images;
		} else  {
			return $this->fields->images ?? [];
		}
	}

	public function getPlanimetries ($type = 'detail'){
		if ($this->fields->assets->planimetry ?? false){
			$images = [];
			foreach ($this->fields->assets->planimetry as $photo){
				$images [] = $photo->$type->url ?? null;
			}
			return $images;
		}
		return $this->fields->images_floor_plans ?? [];
	}

	public function getTitle (){
		// \Nicer::print_r ($item);
		// pre_print_ru ($item);
		$mode = ['sale' => 'in vendita', 'rent' => 'in affitto']  [$this->fields->type]  ?? '';
		$sub_category_name = $this->fields->sub_category->name ?? $this->fields->sub_category_id ?? null;
		$municipality_name = $this->fields->municipality->name ?? null;
		if ($this->hasOption(\Newsboy\Client\v1\AdOptions::ADDRESS_HIDDEN)){
			$address = null;
			$address_number = null;
		} else {
			$address = $this->fields->address ?? null;
			$address_number = $this->fields->address_number ?? null;
			// pre_print_r (['$address'=>$address, '$address_number'=>$address_number]);
		}


		// pre_print_r ($item->fields->title);
		return "{$sub_category_name} {$mode} "
				.($address ? " in {$address}":'')
				.($address_number ? " {$address_number}":'')
				." a {$municipality_name}";
	}

	public function isAffitto(){
		return ($this->fields->type ?? null) == "rent";
	}

	public function isVendita(){
		return ($this->fields->type ?? null) == "sale";
	}




}
