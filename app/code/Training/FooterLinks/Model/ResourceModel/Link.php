<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/1/2016
 * Time: 3:51 PM
 */

namespace Training\FooterLinks\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Link extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('footerlinks_links', 'link_id');
    }
}