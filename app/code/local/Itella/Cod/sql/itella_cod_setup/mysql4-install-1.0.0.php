<?php

$installer = $this;
$installer->startSetup();

$setup = new Mage_Sales_Model_Mysql4_Setup('core_setup');
$setup->startSetup();
$setup->addAttribute('invoice', 'itella_cod_fee', array('type' => 'decimal', 'visible' => false, 'required' => true));
$setup->addAttribute('order', 'itella_cod_fee', array('type' => 'decimal', 'visible' => false, 'required' => true));
$setup->addAttribute('quote', 'itella_cod_fee', array('type' => 'decimal', 'visible' => false, 'required' => true));
$setup->addAttribute('order_address', 'itella_cod_fee', array('type' => 'decimal', 'visible' => false, 'required' => true));
$setup->addAttribute('quote_address', 'itella_cod_fee', array('type' => 'decimal', 'visible' => false, 'required' => true));
$setup->endSetup();

$installer->endSetup();