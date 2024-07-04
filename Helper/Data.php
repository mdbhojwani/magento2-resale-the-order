<?php
/**
 * @category Mdbhojwani
 * @package Mdbhojwani_ResaleTheOrder
 * @author Manish Bhojwani <manishbhojwani3@gmail.com>
 * @github https://github.com/mdbhojwani
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Mdbhojwani\ResaleTheOrder\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    /**
     * Module config path
     */
    const CONFIG_MODULE_IS_ENABLED = 'resaletheorder/general/enabled';
    const CONFIG_MODULE_TITLE = 'resaletheorder/general/title';

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return (bool) $this->scopeConfig->getValue(
            self::CONFIG_MODULE_IS_ENABLED, 
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * title
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->scopeConfig->getValue(
            self::CONFIG_MODULE_TITLE, 
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}