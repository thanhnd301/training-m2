<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/1/2016
 * Time: 3:50 PM
 */

namespace Training\FooterLinks\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Link extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'footerlinks_footerlink';

    protected function _construct()
    {
        $this->_init('Training\FooterLinks\Model\ResourceModel\Link');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}