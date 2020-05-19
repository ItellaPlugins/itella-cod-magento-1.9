<?php
  
class Itella_Cod_Block_Form extends Mage_Payment_Block_Form
{
	protected $_order;
	protected $_quote; 
	
	protected function getSession()
	{
		if (Mage::getDesign()->getArea() == 'adminhtml')
			return Mage::getSingleton('adminhtml/session_quote');
		
		return Mage::getSingleton('checkout/session');
	}
	
	protected function _construct()
	{
		parent::_construct();
		$this->setTemplate('itella_cod/form.phtml');
	}
	
	protected function getOrder()
	{
		if ($this->_order)
			return $this->_order;
			
		$this->_order = Mage::getModel('sales/order');
		$this->_order->loadByIncrementId($this->getSession()->getLastRealOrderId());
		
		return $this->_order;
	}
	
	protected function getQuote()
	{
		if ($this->_quote)
			return $this->_quote;
		
		$this->_quote = $this->getSession()->getQuote();
	
		return $this->_quote;
	}
}
