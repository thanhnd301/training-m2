<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 8/31/2016
 * Time: 9:53 AM
 */

namespace Training\FooterLinks\Model;

use Magento\FrameWork\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class LinkGroup extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'footerlinks_linkgroup';

    protected function _construct()
    {
        $this->_init('Training\FooterLinks\Model\ResourceModel\LinkGroup');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}