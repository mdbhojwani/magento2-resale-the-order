<?php
/**
 * Mdbhojwani
 * Copyright (C) 2021 Mdbhojwani
 *
 * @package Mdbhojwani_ResaleTheOrder
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author Mdbhojwani
 */
namespace Mdbhojwani\ResaleTheOrder\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class AddMarginToOrderObserver implements ObserverInterface
{

    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        $quote = $observer->getQuote();
		$order = $observer->getOrder();
		
        $marginEarned = $quote->getMarginEarned();
        
        if ($yourMargin) {
			$order->setData('margin_earned', $marginEarned);
        }

        return $this;

    }
}
