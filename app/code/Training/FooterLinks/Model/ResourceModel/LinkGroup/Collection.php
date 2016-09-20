<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 8/31/2016
 * Time: 10:11 AM
 */

namespace Training\FooterLinks\Model\ResourceModel\LinkGroup;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Training\FooterLinks\Model\LinkGroup', 'Training\FooterLinks\Model\ResourceModel\LinkGroup');
    }
}