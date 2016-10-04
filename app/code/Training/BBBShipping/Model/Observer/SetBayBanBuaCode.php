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
use Magento\Framework\ObjectManagerInterface;

class SetBayBanBuaCode implements ObserverInterface
{
    protected $_scopeConfig;
    protected $_objectManager;

    public function __construct(ScopeConfigInterface $scopeConfig, ObjectManagerInterface $objectManager)
    {
        $this->_scopeConfig = $scopeConfig;
        $this->_objectManager = $objectManager;
    }

    public function execute(Observer $observer)
    {
        $orderIds = $observer->getEvent()->getOrderIds();

        // Create random code
        $alphanumberic = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $baybanbua_code = substr(str_shuffle($alphanumberic),0,19);

        // Add baybanbua_code to order grid
        $orderGridModel = $this->_objectManager->create('Training\BBBShipping\Model\OrderGrid');
        $orderGridData = $orderGridModel->load($orderIds[0])->getData();
        $shippingInfomation = explode(' - ',$orderGridData['shipping_information']);
        $bbbTitle = $this->_scopeConfig->getValue('carriers/baybanbua/title');
        if($bbbTitle == $shippingInfomation[0])
        {
            $orderGridData['bbb_code'] = $baybanbua_code;
            $orderGridModel->setData($orderGridData);
            $orderGridModel->save();
        }
    }
}