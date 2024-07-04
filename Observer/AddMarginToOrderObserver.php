<?php
/**
 * @category Mdbhojwani
 * @package Mdbhojwani_ResaleTheOrder
 * @author Manish Bhojwani <manishbhojwani3@gmail.com>
 * @github https://github.com/mdbhojwani
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Mdbhojwani\ResaleTheOrder\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Mdbhojwani\ResaleTheOrder\Helper\Data as Helper;

/**
 * Class AddMarginToOrderObserver
 */
class AddMarginToOrderObserver implements ObserverInterface
{
    /**
     * @param Helper $helper
     */
    public function __construct(
        Helper $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this|string|void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $quote = $observer->getQuote();
		$order = $observer->getOrder();
		
        $marginEarned = $quote->getMarginEarned();
        
        if ($marginEarned) {
			$order->setData('margin_earned', $marginEarned);
        }

        return $this;
    }
}
