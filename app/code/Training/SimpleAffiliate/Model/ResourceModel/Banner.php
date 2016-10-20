<?php
/**
 * Created by PhpStorm.
 * User: thanhnd1
 * Date: 20/10/2016
 * Time: 10:40
 */

namespace Training\SimpleAffiliate\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Banner extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('affiliate_banner','banner_id');
    }
}