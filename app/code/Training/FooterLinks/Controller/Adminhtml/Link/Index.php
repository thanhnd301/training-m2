<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/1/2016
 * Time: 2:53 PM
 */

namespace Training\FooterLinks\Controller\Adminhtml\Link;

use Training\FooterLinks\Controller\Adminhtml\LinkAbstract;

class Index extends LinkAbstract
{
    /**
     * @return void
     */
    public function execute()
    {
        // Not set link group redirect to link group management
        if(!$this->getRequest()->getParam('linkgroup'))
        {
            $this->_redirect('footerlinks/linkgroup/index');
        }

        // Set links group id
        if($this->_getSession()->getGroupId() != $this->getRequest()->getParam('linkgroup')
            || null == $this->_getSession()->getGroupId())
        {
            $this->_getSession()->setGroupId($this->getRequest()->getParam('linkgroup'));
        }

        //Call page factory to render layout and page content
        $resultPage = $this->_resultPageFactory->create();

        //Set the menu which will be active for this page
        $resultPage->setActiveMenu('Training_FooterLinks::training');

        //Set the header title of grid
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Footer Link'));

        //Add bread crumb
        $resultPage->addBreadcrumb(__('Training'), __('Training'));
        $resultPage->addBreadcrumb(__('Group Link'), __('Group Link'));
        $resultPage->addBreadcrumb(__('Footer Link'), __('Manage Link'));

        return $resultPage;
    }
}