<?php
/**
 * Yandex Delivery
 * 
 * @author Slava Yurthev
 */
class SY_YandexDelivery_Block_Cleaner extends Mage_Core_Block_Template {
	public function __construct(){
		$quote = Mage::getSingleton('checkout/session')->getQuote();
		$shipping_method = $quote->getShippingAddress()->getData('shipping_method');
		if($shipping_method == 'sy_yandex_delivery_widget'){
			// Unset Yandex Delivery Method
			$quote->getShippingAddress()->setShippingMethod(NULL);
			$quote->getShippingAddress()->setShippingDescription(NULL);
			$quote->getShippingAddress()->setShippingAmount(NULL);
			$quote->setYandexDeliveryName(NULL);
			$quote->setYandexDeliveryPrice(NULL);
			$quote->setYandexDeliveryDescription(NULL);
			$quote->save();
			// Reset totals after unset
			$quote = Mage::getSingleton('checkout/session')->getQuote();
			$quote->getShippingAddress()->setCollectShippingRates(true);
			$quote->getShippingAddress()->collectShippingRates();
			$quote->setTotalsColl‌​ectedFlag(false); 
			$quote->collectTotals(); 
			$quote->save();
		}
	}
}