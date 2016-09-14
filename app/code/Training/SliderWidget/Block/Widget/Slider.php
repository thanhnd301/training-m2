<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/12/2016
 * Time: 11:22 AM
 */

namespace Training\SliderWidget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Slider extends Template implements BlockInterface
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('widget/slider.phtml');
    }
}