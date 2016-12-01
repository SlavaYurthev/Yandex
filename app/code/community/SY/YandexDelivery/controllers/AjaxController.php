<?php
/**
 * Yandex Delivery
 * 
 * @author Slava Yurthev
 */
class SY_YandexDelivery_AjaxController extends Mage_Core_Controller_Front_Action {
	public function getLastIdAction(){
		$response = array('id'=>Mage::getSingleton('checkout/session')->getLastOrderId());
		$this->getResponse()->setHeader('Content-type', 'application/json');
		$this->getResponse()->setBody(json_encode($response));
	}
	public function setOrderIdAction(){
		if($this->getRequest()->getParam('id') && $this->getRequest()->getParam('order_id')){
			$_order = Mage::getModel('sales/order')->load($this->getRequest()->getParam('id'));
			$_order->setYandexDeliveryOrderId($this->getRequest()->getParam('order_id'))->save();
		}
	}
	public function updateAction(){
		$quote = Mage::getSingleton('checkout/session')->getQuote();
		if($price = $this->getRequest()->getParam('price')){
			$quote->setYandexDeliveryPrice($price);
			$quote->getShippingAddress()->setShippingAmount($price);
		}
		if($name = $this->getRequest()->getParam('name')){
			$quote->setYandexDeliveryName($name);
			$quote->getShippingAddress()->setShippingDescription($name);
		}
		if($description = $this->getRequest()->getParam('description')){
			$quote->setYandexDeliveryDescription($description);
		}
		$quote->getShippingAddress()->setShippingMethod('sy_yandex_delivery_widget');
		// And save
		$quote->save();
		// After - reset totals
		$quote = Mage::getSingleton('checkout/session')->getQuote();
		$quote->getShippingAddress()->setCollectShippingRates(true);
		$quote->getShippingAddress()->collectShippingRates();
		$quote->setTotalsColl‌​ectedFlag(false); 
		$quote->collectTotals(); 
		$quote->save();
	}
}