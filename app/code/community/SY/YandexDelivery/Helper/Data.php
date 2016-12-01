<?php
/**
 * Yandex Delivery
 * 
 * @author Slava Yurthev
 */
class SY_YandexDelivery_Helper_Data extends Mage_Core_Helper_Data {
	public function getStoreConfig($key){
		return Mage::getStoreConfig('sy_yandex_delivery/general/'.$key);
	}
	public function getStoreKey($key){
		return Mage::getStoreConfig('sy_yandex_delivery/keys/'.$key);
	}
}