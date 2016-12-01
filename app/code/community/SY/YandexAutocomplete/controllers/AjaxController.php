<?php
/**
 * Yandex Autocomplete
 * 
 * @author Slava Yurthev
 */
class SY_YandexAutocomplete_AjaxController extends Mage_Core_Controller_Front_Action {
	public function postcodeAction(){
		$post = Mage::app()->getRequest()->getParams();
		$uri = Mage::app()->getRequest()->getParam('uri').'getIndex';
		if(isset($post['uri'])){
			unset($post['uri']);
		}
		$this->getResponse()->setHeader('Content-type', 'application/json');
		$this->getResponse()->setBody($this->call($post, $uri, 'getIndex'));
	}
	public function autocompleteAction(){
		$post = Mage::app()->getRequest()->getParams();
		$uri = Mage::app()->getRequest()->getParam('uri').'autocomplete';
		if(isset($post['uri'])){
			unset($post['uri']);
		}
		$this->getResponse()->setHeader('Content-type', 'application/json');
		$this->getResponse()->setBody($this->call($post, $uri, 'autocomplete'));
	}
	protected function getSecretKey($params, $method){
		$api_key = Mage::helper('sy_yandex_autocomplete')->getStoreKey($method);
		$api_key = Mage::helper('core')->decrypt($api_key);
		return md5(implode("", $params).$api_key);
	}
	protected function call($post, $uri, $method){
		ksort($post);
		$post['secret_key'] = $this->getSecretKey($post, $method);
		$ch = curl_init($uri);
		curl_setopt($ch, CURLOPT_URL, $uri);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded','Content-Length: '.strlen(http_build_query($post))));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}
}