<?php
    /**
     * Magento
     *
     * NOTICE OF LICENSE
     *
     * This source file is subject to the Open Software License (OSL 3.0)
     * that is bundled with this package in the file LICENSE.txt.
     * It is also available through the world-wide-web at this URL:
     * http://opensource.org/licenses/osl-3.0.php
     * If you did not receive a copy of the license and are unable to
     * obtain it through the world-wide-web, please send an email
     * to license@magentocommerce.com so we can send you a copy immediately.
     *
     * DISCLAIMER
     *
     * Do not edit or add to this file if you wish to upgrade Magento to newer
     * versions in the future. If you wish to customize Magento for your
     * needs please refer to http://www.magentocommerce.com for more information.
     *
     * @category    Mage
     * @package     Mage_Checkout
     * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
     * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
     */

    /**
     * One page checkout status
     *
     * @category   Mage
     * @category   Mage
     * @package    Mage_Checkout
     * @author      Magento Core Team <core@magentocommerce.com>
     */
    class MW_RewardPoints_Block_Checkout_Onepage_Payment_Methods extends Mage_Checkout_Block_Onepage_Payment_Methods
    {
        public function getMethods()
        {
            $methods = $this->getData('methods');
            if(is_null($methods))
            {
                $quote                     = $this->getQuote();
                $store                     = $quote ? $quote->getStoreId() : null;
                $methods                   = $this->helper('payment')->getStoreMethods($store, $quote);
                $total                     = $quote->getBaseSubtotal() + $quote->getShippingAddress()->getBaseShippingAmount();
                $reward_point_sell_product = $quote->getMwRewardpointSellProduct();
                foreach ($methods as $key => $method)
                {
                    if($this->_canUseMethod($method)
                        && ($total != 0
                            || $method->getCode() == 'free'
                            || $method->getCode() == 'rewardpoints'
                            || ($quote->hasRecurringItems() && $method->canManageRecurringProfiles()))
                    )
                    {
                        if($reward_point_sell_product > 0 && $method->getCode() == 'free')
                        {
                            unset($methods[$key]);
                        }
                        else
                        {
                            $this->_assignMethod($method);
                        }
                        //$this->_assignMethod($method);
                    }
                    else
                    {
                        unset($methods[$key]);
                    }
                }
                $this->setData('methods', $methods);
            }

            return $methods;
        }
    }