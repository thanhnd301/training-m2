<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 10/4/2016
 * Time: 4:58 PM
 */

namespace Training\BBBShipping\Model;

use Magento\FrameWork\Model\AbstractModel;

class OrderGrid extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Training\BBBShipping\Model\ResourceModel\OrderGrid');
    }
}