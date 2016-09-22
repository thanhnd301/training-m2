<?php
/**
 * Created by PhpStorm.
 * User: thanhnd1
 * Date: 22/09/2016
 * Time: 15:50
 */

namespace Training\FooterLinks\Model\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class RemoveFooterLinksBlock implements ObserverInterface
{
    protected $_scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->_scopeConfig = $scopeConfig;
    }

    public function execute(Observer $observer)
    {
        /** @var \Magento\Framework\View\Element\Template $block */
        $block = $observer->getBlock();
        if ($block->getType() == 'Magento\Framework\View\Element\Html\Links')
        {
            $remove = $this->_scopeConfig->getValue(
                'footerlinks/general/enable_in_frontend',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            );

            if ($remove)
            {
                $block->unsetChildren();
            }
        }
    }
}