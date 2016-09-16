<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/13/2016
 * Time: 9:02 AM
 */

namespace Training\SliderWidget\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class Banner extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'sliderwidget_banner';

    protected function _construct()
    {
        $this->_init('Training\SliderWidget\Model\ResourceModel\Banner');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG.'_'.$this->getId()];
    }
}