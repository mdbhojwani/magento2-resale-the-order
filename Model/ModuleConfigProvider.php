<?php
/**
 * @category Mdbhojwani
 * @package Mdbhojwani_ResaleTheOrder
 * @author Manish Bhojwani <manishbhojwani3@gmail.com>
 * @github https://github.com/mdbhojwani
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Mdbhojwani\ResaleTheOrder\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Mdbhojwani\ResaleTheOrder\Helper\Data as Helper;

/**
 * Class ModuleConfigProvider
 */
class ModuleConfigProvider implements ConfigProviderInterface
{
    /**
     * @var Helper
     */
    protected $helper;

    /**
     * @param Helper $helper
     */
    public function __construct(
        Helper $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $configData = [];
        $ExtrafeeConfig['resaletheorder_enabled'] = $this->helper->isEnabled();
        $ExtrafeeConfig['resaletheorder_title'] = $this->helper->getTitle();
        return $ExtrafeeConfig;
    }
}
