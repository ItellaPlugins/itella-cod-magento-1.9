<?php

class Itella_Cod_Model_Sales_Quote_Address_Total_Fee extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
	protected $_code = 'itella_cod';

	public function collect(Mage_Sales_Model_Quote_Address $address)
	{
		$_helper = Mage::helper('itella_cod');
		if (!$_helper->getSession()->getQuoteId()) return $this;
				
		parent::collect($address);
		$_model = Mage::getModel('itella_cod/cashondelivery');
		$quote = $address->getQuote();
		$amount = $_model->getExtraFee();
				
		if (
		($_helper->getQuote()->getPayment()->getMethod() == $_model->getCode()) &&
		($address->getAddressType() == Mage_Sales_Model_Quote_Address::TYPE_SHIPPING)
		) {
            
			$address->setGrandTotal($address->getGrandTotal() + $amount);
			$address->setBaseGrandTotal($address->getBaseGrandTotal() + $amount);
			$address->setItellaCodFee($amount);
			$quote->setItellaCodFee($amount);
            
		} elseif ($_helper->getQuote()->getPayment()->getMethod() != $_model->getCode()) {
			$address->setItellaCodFee(0);
			$quote->setItellaCodFee(0);
		}

		return $this;
	}

	public function fetch(Mage_Sales_Model_Quote_Address $address)
	{
		$_helper = Mage::helper('itella_cod');
		if (!$_helper->getSession()->getQuoteId()) return $this;
		
		parent::fetch($address);

		if ($address->getAddressType() != Mage_Sales_Model_Quote_Address::TYPE_SHIPPING)
			return $this;

		$_model = Mage::getModel('itella_cod/cashondelivery');
		
		$amount = $_model->getExtraFee();

		if ($amount > 0 && $_helper->getQuote()->getPayment()->getMethod() == $_model->getCode())
		{
	        $address->addTotal(array(
	            'code'  => $_model->getCode(),
	            'title' => $_helper->__('COD Fee'),
	            'value' => $amount,
	        ));
		}
		
	    return $this;
	}

	/**
	 * Get Subtotal label
	 *
	 * @return string
	 */
	public function getLabel()
	{
		return Mage::helper('itella_cod')->__('COD Fee');
	}
}
