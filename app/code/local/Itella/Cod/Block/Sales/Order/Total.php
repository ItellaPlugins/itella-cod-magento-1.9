<?php

class Itella_Cod_Block_Sales_Order_Total extends Mage_Sales_Block_Order_Totals
{
	public function initTotals(){
		$order = $this->getParentBlock()->getOrder();
		if($order->getItellaCodFee() > 0 || true){
			$this->getParentBlock()->addTotal(new Varien_Object(array(
					'code'  => 'itella_cod',
					'value' => $order->getItellaCodFee(),
					'base_value'    => $order->getItellaCodFee(),
					'label' => Mage::helper('itella_cod')->__('COD Fee'),
			)),'subtotal');
		}
	}
}