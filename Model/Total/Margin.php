<?php
/**
 * Mdbhojwani
 * Copyright (C) 2021 Mdbhojwani
 *
 * @package Mdbhojwani_ResaleTheOrder
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author Mdbhojwani
 */
namespace Mdbhojwani\ResaleTheOrder\Model\Total;


class Margin extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
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
    
    public function __construct(\Magento\Quote\Model\QuoteValidator $quoteValidator)
    {
        $this->quoteValidator = $quoteValidator;
    }

    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);
      
        $marginEarned = $quote->getMarginEarned();
        
        // $total->setTotalAmount('margin_earned', $marginEarned);
        // $total->setBaseTotalAmount('margin_earned', $marginEarned);

        $total->setMarginEarned($marginEarned);
        $total->setBaseMarginEarned($marginEarned);
        
        $total->setGrandTotal($total->getGrandTotal() + $marginEarned);
        $total->setBaseGrandTotal($total->getBaseGrandTotal() + $marginEarned);


        return $this;
    } 
    
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
    public function fetch(\Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\Quote\Address\Total $total)
    {
        return [
            'code' => 'margin_earned',
            'title' => 'Margin Earned',
            'value' => $total->getMarginEarned()
        ];
    }

    /**
     * Get Subtotal label
     *
     * @return \Magento\Framework\Phrase
     */
    public function getLabel()
    {
        return __('Margin Earned');
    }
}