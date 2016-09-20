<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/13/2016
 * Time: 9:09 AM
 */

namespace Training\SliderWidget\Model\ResourceModel\Banner;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Training/SliderWidget/Model/Banner','Training/SliderWidget/Model/ResourceModel/Banner');
    }

}