<?php
/**
 * @category Mdbhojwani
 * @package Mdbhojwani_ResaleTheOrder
 * @author Manish Bhojwani <manishbhojwani3@gmail.com>
 * @github https://github.com/mdbhojwani
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Mdbhojwani\ResaleTheOrder\Model\Invoice\Total;

use Magento\Sales\Model\Order\Invoice\Total\AbstractTotal;
use Mdbhojwani\ResaleTheOrder\Helper\Data as Helper;

/**
 * Class Margin
 */
class Margin extends AbstractTotal
{
    /**
     * @var Helper
     */
    private $helper;
    
    /**
     * Helper $helper
     */
    public function __construct(
        Helper $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * @param \Magento\Sales\Model\Order\Invoice $invoice
     * @return $this
     */
    public function collect(\Magento\Sales\Model\Order\Invoice $invoice)
    {
        $invoice->setMarginEarned(0);
        if ($this->helper->isEnabled()) {
            $marginEarned = $invoice->getOrder()->getMarginEarned();
            $invoice->setMarginEarned($marginEarned);

            $invoice->setGrandTotal($invoice->getGrandTotal() + $invoice->getMarginEarned());
            $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $invoice->getMarginEarned());
        }
        return $this;
    }
}