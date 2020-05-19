<?php

class Itella_Cod_Model_Source_Type
{
    public function toOptionArray()
    {
        $_helper = Mage::helper('itella_cod');
        $arr = array();
        $arr[] = array('value' => 'fixed', 'label' => $_helper->__('Fixed fee'));
        $arr[] = array('value' => 'percent', 'label' => $_helper->__('Percent fee'));
        return $arr;
    }
}
