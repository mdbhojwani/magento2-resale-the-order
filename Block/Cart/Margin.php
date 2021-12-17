<?php
/**
 * Mdbhojwani
 * Copyright (C) 2021 Mdbhojwani
 *
 * @package Mdbhojwani_ResaleTheOrder
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author Mdbhojwani
 */
namespace Mdbhojwani\ResaleTheOrder\Block\Cart;

/**
 * Block with apply margin form.
 *
 * @api
 * @since 100.0.2
 */
class Margin extends \Magento\Checkout\Block\Cart\AbstractCart
{
    private $priceHelper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Magento\Framework\Pricing\Helper\Data $priceHelper
     * @param array $data
     * @codeCoverageIgnore
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\Pricing\Helper\Data $priceHelper,
        array $data = []
    ) {
        parent::__construct($context, $customerSession, $checkoutSession, $data);
        $this->_isScopePrivate = true;
        $this->priceHelper = $priceHelper;
    }

    /**
     * Margin Earned.
     *
     * @return string
     * @codeCoverageIgnore
     */
    public function getMarginEarned()
    {
        return $this->getQuote()->getMarginEarned();
    }

    /**
     * Formatted Price.
     *
     * @var $price
     * @return string
     * @codeCoverageIgnore
     */
    public function getFormattedPrice($price)
    {
        return $this->priceHelper->currency($price, true, false);
    }
}
