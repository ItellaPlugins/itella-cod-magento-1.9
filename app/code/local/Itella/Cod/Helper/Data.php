<?php

class Itella_Cod_Helper_Data extends Mage_Core_Helper_Abstract
{
	
	protected $_rate = null;


	/**
	 * Get currenct checkout/admin session
	 *
	 * @return Varien_Object
	 */
	public function getSession()
	{
		if (Mage::app()->getStore()->isAdmin() || !Mage::app()->getStore()->getId() ) 
			return Mage::getSingleton('adminhtml/session_quote');
		
		return Mage::getSingleton('checkout/session');
	}

	/**
	 * Get current quote
	 *
	 * @return Mage_Sales_Model_Quote
	 */
	public function getQuote()
	{
		return $this->getSession()->getQuote();
	}

	public function getCodDescription($storeId = null) {
		return Mage::getStoreConfig('payment/itella_cod/cod_description', $storeId);
	}
    
    public function getFreeFrom($storeId = null) {
		return Mage::getStoreConfig('payment/itella_cod/free_from', $storeId);
	}

	public function getFixedFee($storeId = null)
	{
		return (float)Mage::getStoreConfig('payment/itella_cod/fixed_fee', $storeId);
		
	}
    
    public function getPercentFee($storeId = null)
	{
		return (float)Mage::getStoreConfig('payment/itella_cod/percent_fee', $storeId);
		
	}
    
    public function getFeeType($storeId = null)
	{
		return (string)Mage::getStoreConfig('payment/itella_cod/fee_type', $storeId);
		
	}

	public function currencyConvert($amount) {
		$baseCurrencyCode = Mage::app()->getStore()->getBaseCurrencyCode();
		$currentCurrencyCode = Mage::app()->getStore()->getCurrentCurrencyCode();

		return Mage::helper('directory')->currencyConvert($amount, $baseCurrencyCode, $currentCurrencyCode);
	}

}
