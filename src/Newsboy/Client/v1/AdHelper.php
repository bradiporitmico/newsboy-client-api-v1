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
  public function offsetSet(mixed $offset, mixed $value) : void {
  	$this->fields->$offset = $value;
  }

  public function offsetExists(mixed $offset) : bool {
  	return isset($this->fields->$offset);
  }

	public function offsetUnset(mixed $offset) : void {
  	unset($this->fields->$offset);
  }
	
	public function offsetGet(mixed $offset) : mixed  {
  	return $this->fields->$offset ?? null;
  }

	public function isAddressHidden() : bool{
		return $this->hasOption(\Newsboy\Client\v1\AdOptions::ADDRESS_HIDDEN);
	}

	public function isPriceHidden() : bool{
		return $this->hasOption(\Newsboy\Client\v1\AdOptions::PRICE_HIDDEN) || $this->hasOption(\Newsboy\Client\v1\AdOptions::PRICE_PRIVATE_NOGOTIATION);
	}

	public function isGeoPositionHidden() : bool{
		return $this->hasOption(\Newsboy\Client\v1\AdOptions::POSITION_HIDDEN);
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


}
