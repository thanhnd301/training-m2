<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 10/4/2016
 * Time: 4:22 PM
 */

namespace Training\BBBShipping\Model\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class SetBayBanBuaCode implements ObserverInterface
{
    protected $_scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->_scopeConfig = $scopeConfig;
    }

    public function execute(Observer $observer)
    {
        /** @var \Magento\Framework\View\Element\Template $block */
        // Add baybanbua_code to order grid
    }
}