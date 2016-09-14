<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/1/2016
 * Time: 3:53 PM
 */

namespace Training\FooterLinks\Model\ResourceModel\Link;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Training\FooterLinks\Model\Link', 'Training\FooterLinks\Model\ResourceModel\Link');
    }
}