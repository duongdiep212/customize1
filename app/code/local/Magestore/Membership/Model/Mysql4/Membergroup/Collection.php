<?php

class Magestore_Membership_Model_Mysql4_Membergroup_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('membership/membergroup');
    }
}