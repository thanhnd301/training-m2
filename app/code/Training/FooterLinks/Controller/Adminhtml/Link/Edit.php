<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/5/2016
 * Time: 9:41 AM
 */

namespace Training\FooterLinks\Controller\Adminhtml\Link;

use Training\FooterLinks\Controller\Adminhtml\LinkAbstract;

class Edit extends LinkAbstract
{
    /**
     * @return void
     */
    public function execute()
    {
        $linkId = $this->getRequest()->getParam('id');

        /** @var \Training\FooterLinks\Model\Link $model */
        $model = $this->_linkFactory->create();

        if ($linkId) {
            $model->load($linkId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This link no longer exists.'));
                $this->_redirect('*/*/index');
                return;
            }
            $this->_coreRegistry->register('link_id',$model->getId());
        }

        $linkData["footerlink"] =  $model->getData();
        $linkData["footerlink"]["id"] = $model->getId();
        $linkData["link_id"] = $model->getId();
        $this->_getSession()->setFooterlinkData($linkData);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Training_FooterLinks::training');
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('New Footer Link'));

        return $resultPage;
    }
}