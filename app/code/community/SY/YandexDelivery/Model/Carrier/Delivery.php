<?php
/**
 * Yandex Delivery
 * 
 * @author Slava Yurthev
 */
class SY_YandexDelivery_Model_Carrier_Delivery
    extends Mage_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface{
    protected $_code = 'sy_yandex_delivery';
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (Mage::getStoreConfig('carriers/sy_yandex_delivery/active') == "1" &&
            !Mage::app()->getStore()->isAdmin()) {
            $quote = Mage::getSingleton('checkout/session')->getQuote();
            $title = Mage::getStoreConfig('carriers/sy_yandex_delivery/method_title');
            $price = 0;
            if($quote->getYandexDeliveryName()){
                $title = $quote->getYandexDeliveryName();
            }
            if($quote->getYandexDeliveryPrice()){
                $price = $quote->getYandexDeliveryPrice();
            }
            $result = Mage::getModel('shipping/rate_result');
            $method = Mage::getModel('shipping/rate_result_method');
            $method->setCarrier($this->_code)
                ->setCarrierTitle($this->getConfigData('name'))
                ->setMethod('widget')
                ->setMethodTitle($title)
                ->setPrice($price)
                ->setCost($price);

            $result->append($method);
            return $result;
        }
    }
    public function getAllowedMethods(){
        return array($this->_code => $this->getConfigData('name'));
    }
    public function isTrackingAvailable(){
        return true;
    }
}
