<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 10/4/2016
 * Time: 5:00 PM
 */

namespace Training\BBBShipping\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class OrderGrid extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('sales_order_grid', 'entity_id');
    }
}