<?php
/**
 * Yandex Autocomplete
 * 
 * @author Slava Yurthev
 */
class SY_YandexAutocomplete_Helper_Data extends Mage_Core_Helper_Data {
	public function getStoreConfig($key){
		return Mage::getStoreConfig('sy_yandex_autocomplete/general/'.$key);
	}
	public function getStoreKey($key){
		return Mage::getStoreConfig('sy_yandex_autocomplete/keys/'.$key);
	}
}