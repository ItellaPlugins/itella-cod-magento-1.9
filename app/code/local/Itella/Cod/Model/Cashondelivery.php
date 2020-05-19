<?php


class Itella_Cod_Model_Cashondelivery extends Mage_Payment_Model_Method_Abstract
{
	protected $_code = 'itella_cod';
	protected $_paymentMethod = 'itella_cod';
	//protected $_formBlockType = 'itella_cod/form';
    protected $_formBlockType = 'payment/form_cashondelivery';
    protected $_infoBlockType = 'payment/info';

	protected $_isGateway = false;
	protected $_canAuthorize = true;
	protected $_canCapture = false;
	protected $_canCapturePartial = false;
	protected $_canRefund = false;
	protected $_canVoid = true;
	protected $_canUseInternal = true;
	protected $_canUseCheckout = true;
	protected $_canUseForMultishipping = true;

	public function getExtraFee() {
		$_helper = Mage::helper('itella_cod');
		return $_helper->currencyConvert($this->getBaseExtraFee());
	}
	
	
	public function getBaseExtraFee() {
		$_helper = Mage::helper('itella_cod');
		$_quote = $_helper->getQuote();

		if (!count($_quote->getAllItems())) return 0;
		
		$_subTotal = $_quote->getShippingAddress()->getSubtotal();
		$_shippingAmount = $_quote->getShippingAddress()->getBaseShippingAmount();

		
        $feeType = $_helper->getFeeType();
		$fixedFee = $_helper->getFixedFee();
        $percentFee = $_helper->getPercentFee();
        $freeFrom = $_helper->getFreeFrom();
        
		$extraFee = 0;
        if ($feeType == "percent"){
            $extraFee = $percentFee * $_subTotal /100;
        }
        if ($feeType == "fixed"){
            $extraFee = $fixedFee;
        }
        if ($freeFrom != '' && $freeFrom > 0 && $freeFrom < $_subTotal){
            $extraFee = 0;
        }

		return $extraFee;
	}
    
    public function isAvailable($quote = null)
    {
        $checkResult = new StdClass;
        $isActive = (bool)(int)$this->getConfigData('active', $quote ? $quote->getStoreId() : null);
        $checkResult->isAvailable = $isActive;
        $checkResult->isDeniedInConfig = !$isActive; // for future use in observers
        Mage::dispatchEvent('payment_method_is_active', array(
            'result'          => $checkResult,
            'method_instance' => $this,
            'quote'           => $quote,
        ));

        if ($checkResult->isAvailable && $quote) {
            $checkResult->isAvailable = $this->isApplicableToQuote($quote, self::CHECK_RECURRING_PROFILES);
            if ($quote->getShippingAddress()->getShippingMethod() == "itella_PARCEL_TERMINAL"){
                $checkResult->isAvailable = false;
            }
        }
        return $checkResult->isAvailable;
    }
    
    public function getInstructions()
    {
        return trim($this->getConfigData('cod_description'));
    }

}
