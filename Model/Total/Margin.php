<?php
/**
 * @category Mdbhojwani
 * @package Mdbhojwani_ResaleTheOrder
 * @author Manish Bhojwani <manishbhojwani3@gmail.com>
 * @github https://github.com/mdbhojwani
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Mdbhojwani\ResaleTheOrder\Model\Total;

use Magento\Quote\Model\Quote\Address\Total\AbstractTotal;
use Magento\Quote\Model\QuoteValidator;
use Mdbhojwani\ResaleTheOrder\Helper\Data as Helper;

/**
 * Class Margin
 */
class Margin extends AbstractTotal
{
   /**
     * Collect grand total address amount
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return $this
     */
    protected $quoteValidator = null;

    /**
     * @var Helper
     */
    private $helper;
    
    /**
     * \Magento\Quote\Model\QuoteValidator $quoteValidator
     * Helper $helper
     */
    public function __construct(
        QuoteValidator $quoteValidator,
        Helper $helper
    ) {
        $this->quoteValidator = $quoteValidator;
        $this->helper = $helper;
    }

    /**
     * Collect Margin and save against order
     */
    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);
        
        if ($this->helper->isEnabled()) {
            $marginEarned = $quote->getMarginEarned();
        
            // $total->setTotalAmount('margin_earned', $marginEarned);
            // $total->setBaseTotalAmount('margin_earned', $marginEarned);

            $total->setMarginEarned($marginEarned);
            $total->setBaseMarginEarned($marginEarned);
            
            $total->setGrandTotal($total->getGrandTotal() + $marginEarned);
            $total->setBaseGrandTotal($total->getBaseGrandTotal() + $marginEarned);
        } else {
            $total->setMarginEarned(0);
            $total->setBaseMarginEarned(0);
            $total->setGrandTotal($total->getGrandTotal());
            $total->setBaseGrandTotal($total->getBaseGrandTotal());
        }

        return $this;
    } 
    
    /**
     * Clear totals
     */
    protected function clearValues(Address\Total $total)
    {
        $total->setTotalAmount('subtotal', 0);
        $total->setBaseTotalAmount('subtotal', 0);
        $total->setTotalAmount('tax', 0);
        $total->setBaseTotalAmount('tax', 0);
        $total->setTotalAmount('discount_tax_compensation', 0);
        $total->setBaseTotalAmount('discount_tax_compensation', 0);
        $total->setTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setBaseTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setSubtotalInclTax(0);
        $total->setBaseSubtotalInclTax(0);
    }
    
    /**
     * Assign subtotal amount and label to address object
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param Address\Total $total
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function fetch(
        \Magento\Quote\Model\Quote $quote, 
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        if ($this->helper->isEnabled()) {
            return [
                'code' => 'margin_earned',
                'title' => $this->helper->getTitle(),
                'value' => $quote->getMarginEarned()
            ];
        }
        
        return [];
    }

    /**
     * Get Subtotal label
     *
     * @return \Magento\Framework\Phrase
     */
    public function getLabel()
    {
        return $this->helper->getTitle();
    }
}