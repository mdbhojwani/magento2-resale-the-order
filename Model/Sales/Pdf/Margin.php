<?php
/**
 * @category Mdbhojwani
 * @package Mdbhojwani_ResaleTheOrder
 * @author Manish Bhojwani <manishbhojwani3@gmail.com>
 * @github https://github.com/mdbhojwani
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Mdbhojwani\ResaleTheOrder\Model\Sales\Pdf;

use Mdbhojwani\ResaleTheOrder\Helper\Data as Helper;

/**
 * Class Margin
 */
class Margin extends \Magento\Sales\Model\Order\Pdf\Total\DefaultTotal
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
     * Display Margin in PDF
     */
    public function getTotalsForDisplay()
    {
        if (!$this->helper->isEnabled()) {
            return [];
        }
        
        $amount = $this->getOrder()->formatPriceTxt($this->getAmount());
        if ($this->getAmountPrefix()) {
            $amount = $this->getAmountPrefix() . $amount;
        }

        $title = __($this->getTitle());
        if ($this->getTitleSourceField()) {
            $label = $title . ' (' . $this->getTitleDescription() . '):';
        } else {
            $label = $title . ':';
        }

        $fontSize = $this->getFontSize() ? $this->getFontSize() : 7;
        $total = ['amount' => $amount, 'label' => $label, 'font_size' => $fontSize];
        return [$total];
    }
}
