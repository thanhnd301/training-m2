<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 8/31/2016
 * Time: 10:08 AM
 */

namespace Training\FooterLinks\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class LinkGroup extends  AbstractDb
{
    protected function _construct()
    {
        $this->_init('footerlinks_groups', 'group_id');
    }
}