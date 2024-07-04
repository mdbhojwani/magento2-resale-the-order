<?php
/**
 * @category Mdbhojwani
 * @package Mdbhojwani_ResaleTheOrder
 * @author Manish Bhojwani <manishbhojwani3@gmail.com>
 * @github https://github.com/mdbhojwani
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Mdbhojwani\ResaleTheOrder\Model\Creditmemo\Total;

use Magento\Sales\Model\Order\Creditmemo\Total\AbstractTotal;
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
    public function collect(\Magento\Sales\Model\Order\Creditmemo $creditmemo)
    {
        $creditmemo->setMarginEarned(0);
        if ($this->helper->isEnabled()) {
            $marginEarned = $creditmemo->getOrder()->getMarginEarned();
            $creditmemo->setMarginEarned($marginEarned);

            $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $creditmemo->getMarginEarned());
            $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $creditmemo->getMarginEarned());
        }
        return $this;
    }
}