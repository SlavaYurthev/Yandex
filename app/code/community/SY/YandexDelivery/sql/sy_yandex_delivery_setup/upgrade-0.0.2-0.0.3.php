<?php
/**
 * Yandex Delivery
 * 
 * @author Slava Yurthev
 */
$helper = Mage::helper('sy_yandex_delivery');
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
/*
$installer->addAttribute('catalog_product', 'weight', array(
      'group' => 'General',
      'type' => 'int',
      'backend' => '',
      'frontend' => '',
      'label' => $helper->__('Weight'),
      'input' => 'text',
      'class' => '',
      'source' => '',
      'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
      'visible' => false,
      'required' => true,
      'user_defined' => false,
      'default' => '0',
      'searchable' => false,
      'filterable' => false,
      'comparable' => false,
      'visible_on_front' => false,
      'unique' => false,
      'apply_to' => '',
      'is_configurable' => false
));
*/
$installer->addAttribute('catalog_product', 'height', array(
      'group' => 'General',
      'type' => 'int',
      'backend' => '',
      'frontend' => '',
      'label' => $helper->__('Height'),
      'input' => 'text',
      'class' => '',
      'source' => '',
      'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
      'visible' => false,
      'required' => true,
      'user_defined' => false,
      'default' => '0',
      'searchable' => false,
      'filterable' => false,
      'comparable' => false,
      'visible_on_front' => false,
      'unique' => false,
      'apply_to' => '',
      'is_configurable' => false
));

$installer->addAttribute('catalog_product', 'length', array(
      'group' => 'General',
      'type' => 'int',
      'backend' => '',
      'frontend' => '',
      'label' => $helper->__('Length'),
      'input' => 'text',
      'class' => '',
      'source' => '',
      'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
      'visible' => false,
      'required' => true,
      'user_defined' => false,
      'default' => '0',
      'searchable' => false,
      'filterable' => false,
      'comparable' => false,
      'visible_on_front' => false,
      'unique' => false,
      'apply_to' => '',
      'is_configurable' => false
));

$installer->addAttribute('catalog_product', 'width', array(
      'group' => 'General',
      'type' => 'int',
      'backend' => '',
      'frontend' => '',
      'label' => $helper->__('Width'),
      'input' => 'text',
      'class' => '',
      'source' => '',
      'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
      'visible' => false,
      'required' => true,
      'user_defined' => false,
      'default' => '0',
      'searchable' => false,
      'filterable' => false,
      'comparable' => false,
      'visible_on_front' => false,
      'unique' => false,
      'apply_to' => '',
      'is_configurable' => false
));

$installer->endSetup();