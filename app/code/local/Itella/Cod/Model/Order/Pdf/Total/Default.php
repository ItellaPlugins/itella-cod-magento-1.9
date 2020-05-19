<?php

class Itella_Cod_Model_Order_Pdf_Total_Default extends Mage_Sales_Model_Order_Pdf_Total_Default
{
	public function getTotalsForDisplay(){
		$_helper = Mage::helper('itella_cod');
		$amount = $this->getOrder()->getItellaCodFee();
		$fontSize = $this->getFontSize() ? $this->getFontSize() : 7;
		if(floatval($amount)){
			$amount = $this->getOrder()->formatPriceTxt($amount);
			if ($this->getAmountPrefix()){
				$discount = $this->getAmountPrefix().$discount;
			}
			$totals = array(array(
					'label' => $_helper->__('COD Fee'),
					'amount' => $amount,
					'font_size' => $fontSize,
			)
			);
			return $totals;
		}
	}
	
	public function canDisplay() {
		return $this->getOrder()->getItellaCodFee() > 0;
	}
}
