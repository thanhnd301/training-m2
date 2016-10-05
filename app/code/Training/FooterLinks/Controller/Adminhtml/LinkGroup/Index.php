<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 8/30/2016
 * Time: 4:24 PM
 */

namespace Training\FooterLinks\Controller\Adminhtml\LinkGroup;

use Training\FooterLinks\Controller\Adminhtml\GroupAbstract;

class Index extends GroupAbstract
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
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Footer Group Link'));

        //Add bread crumb
        $resultPage->addBreadcrumb(__('Training'), __('Training'));
        $resultPage->addBreadcrumb(__('Manage Group Link'), __('Manage Group Link'));

        return $resultPage;
    }
}