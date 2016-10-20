<?php
/**
 * Created by PhpStorm.
 * User: thanhnd1
 * Date: 20/10/2016
 * Time: 10:41
 */

namespace Training\SimpleAffiliate\Model\ResourceModel\Banner;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Training/SimpleAffiliate/Model/Banner','Training/SimpleAffiliate/Model/ResourceModel/Banner');
    }
}