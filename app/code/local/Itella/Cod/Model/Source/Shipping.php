<?php

class Itella_Cod_Model_Source_Shipping {
    public function toOptionArray($isMultiSelect = false)
    {
        $methods = Mage::getSingleton('shipping/config')->getActiveCarriers();

        $options = array();

        foreach($methods as $_code => $_method)
        {
            if(!$_title = Mage::getStoreConfig("carriers/$_code/title"))
                $_title = $_code;

            $options[] = array('value' => $_code, 'label' => $_title . " ($_code)");
        }
        
        return $options;
    }
}