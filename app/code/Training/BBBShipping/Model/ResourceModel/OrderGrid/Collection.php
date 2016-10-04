<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 10/4/2016
 * Time: 5:01 PM
 */

namespace Training\BBBShipping\Model\ResourceModel\OrderGrid;

use Magento\Catalog\Model\ResourceModel\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Training\BBBShipping\Model\OrderGrid', 'Training\BBBShipping\Model\ResourceModel\OrderGrid');
    }
}