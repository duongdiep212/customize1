<?php
    /**
     * User: Anh TO
     * Date: 6/18/14
     * Time: 2:20 PM
     */

    class MW_RewardPoints_Model_Mysql4_Productsellpoint extends Mage_Core_Model_Mysql4_Abstract
    {
        public function _construct()
        {
            // Note that the rewardpoints_id refers to the key field in your database table.
            $this->_init('rewardpoints/productsellpoint', 'id');
        }
    }