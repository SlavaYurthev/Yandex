<?php
/**
 * Yandex Delivery
 * 
 * @author Slava Yurthev
 */
$installer = $this;

$installer->startSetup();

$setup = new Mage_Sales_Model_Mysql4_Setup('core_setup');
$setup->addAttribute('quote', 'yandex_delivery_name', array(
            'group'             => 'General',
            'label'             => 'Yandex Delivery Name',
            'note'              => '',
            'type'              => 'varchar',   
            'input'             => 'text',
            'frontend_class'    => '',
            'source'            => '',
            'backend'           => '',
            'frontend'          => '',
            'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
            'required'          => false,
            'visible_on_front'  => false,
            'is_configurable'   => false,
            'used_in_product_listing'   => false,
        )
);
$setup->addAttribute('quote', 'yandex_delivery_price', array(
            'group'             => 'General',
            'label'             => 'Yandex Delivery Price',
            'note'              => '',
            'type'              => 'varchar',   
            'input'             => 'text',
            'frontend_class'    => '',
            'source'            => '',
            'backend'           => '',
            'frontend'          => '',
            'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
            'required'          => false,
            'visible_on_front'  => false,
            'is_configurable'   => false,
            'used_in_product_listing'   => false,
        )
);
$setup->addAttribute('quote', 'yandex_delivery_description', array(
            'group'             => 'General',
            'label'             => 'Yandex Delivery Description',
            'note'              => '',
            'type'              => 'varchar',   
            'input'             => 'text',
            'frontend_class'    => '',
            'source'            => '',
            'backend'           => '',
            'frontend'          => '',
            'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
            'required'          => false,
            'visible_on_front'  => false,
            'is_configurable'   => false,
            'used_in_product_listing'   => false,
        )
);
$setup->addAttribute('order', 'yandex_delivery_order_id', array(
            'group'             => 'General',
            'label'             => 'Yandex Delivery Order Id',
            'note'              => '',
            'type'              => 'varchar',   
            'input'             => 'text',
            'frontend_class'    => '',
            'source'            => '',
            'backend'           => '',
            'frontend'          => '',
            'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
            'required'          => false,
            'visible_on_front'  => false,
            'is_configurable'   => false,
            'used_in_product_listing'   => false,
        )
);

$installer->endSetup();