<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/12/2016
 * Time: 11:22 AM
 */

namespace Training\SliderWidget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Widget\Block\BlockInterface;
use Training\SliderWidget\Model\ResourceModel\Banner\CollectionFactory;

class Slider extends Template implements BlockInterface
{
    protected $_collectionFactory;

    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        array $data)
    {
        parent::__construct($context, $data);
        $this->_collectionFactory = $collectionFactory;
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('widget/slider.phtml');
    }

    public function getBannerHtml($sliderId)
    {
        $collection = $this->_collectionFactory->create();
        $banners = $collection
            ->addFieldToFilter('status',1)
            ->addFieldToFilter('slider_id',$sliderId)
            ->getData();
        $html = "";
        if($banners)
        {
            foreach ($banners as $banner)
            {
                $link = $banner['link'];
                $image = $this->getBaseUrl().'pub/media/sliderwidget/'.$banner['image'];
                $html .= "<div><a href='$link'><img src='$image'/></a></div>";
            }
        }
        return $html;
    }

    public function canShowInFrontEnd()
    {
        $isEnabled=$this->getConfigValue('sliderwidget/general/enable_in_frontend');
        if($isEnabled)
        {
            return true;
        }
        return false;
    }
}