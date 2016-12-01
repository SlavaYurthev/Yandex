<?php
/**
 * Yandex Delivery
 * 
 * @author Slava Yurthev
 */
class SY_YandexDelivery_Block_Init extends Mage_Core_Block_Template {
	public function getCartHelper(){
		return Mage::helper('checkout/cart');
	}
	public function getQuote(){
		return $this->getCartHelper()->getQuote();
	}
	public function getSubtotal(){
		return $this->getQuote()->getSubtotal();
	}
	public function getItems(){
		return $this->getQuote()->getAllVisibleItems();
	}
	public function getQty(){
		return $this->getCartHelper()->getSummaryCount();
	}
	public function getWeight(){
		return $this->getSummaryAttribute('weight');
	}
	public function getCurrencyCode(){
		return Mage::app()->getStore()->getCurrentCurrencyCode();
	}
	public function getCurrencySymbol(){
		return Mage::app()->getLocale()->currency($this->getCurrencyCode())->getSymbol();
	}
	public function getSummaryAttribute($attribute){
		$default = 0;
		$items = $this->getItems();
		if(count($items)>0){
			foreach ($items as $item) {
				$_product = Mage::getModel('catalog/product')->load($item->getProductId());
				$default += $_product->getData($attribute)*$item->getQty();
			}
		}
		return $default;
	}
}