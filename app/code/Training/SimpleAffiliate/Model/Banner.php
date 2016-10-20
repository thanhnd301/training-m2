<?php
/**
 * Created by PhpStorm.
 * User: thanhnd1
 * Date: 20/10/2016
 * Time: 10:38
 */

namespace Training\SimpleAffiliate\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class Banner extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'affiliate_banner';

    protected function _construct()
    {
        $this->_init('Training\SimpleAffiliate\Model\ResourceModel\Banner');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG.'_'.$this->getId()];
    }
}