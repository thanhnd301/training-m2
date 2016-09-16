<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/14/2016
 * Time: 2:17 PM
 */

namespace Training\SliderWidget\Controller\Adminhtml\Banner;

use Training\SliderWidget\Controller\Adminhtml\BannerAbstract;

class NewAction extends BannerAbstract
{
    /**
     * @return forward edit action
     */
    public function execute()
    {
        return $this->_forward('edit');
    }
}