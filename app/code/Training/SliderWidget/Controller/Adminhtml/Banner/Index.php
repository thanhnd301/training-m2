<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/14/2016
 * Time: 2:06 PM
 */

namespace Training\SliderWidget\Controller\Adminhtml\Banner;

use Training\SliderWidget\Controller\Adminhtml\BannerAbstract;

class Index extends BannerAbstract
{
    /**
     * @return void
     */
    public function execute()
    {
        //Call page factory to render layout and page content
        $resultPage = $this->_resultPageFactory->create();

        //Set the menu which will be active for this page
        $resultPage->setActiveMenu('Training_FooterLinks::training');

        //Set the header title of grid
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Banner'));

        //Add bread crumb
        $resultPage->addBreadcrumb(__('Training'), __('Training'));
        $resultPage->addBreadcrumb(__('Banner'), __('Manage Banner'));

        return $resultPage;
    }
}