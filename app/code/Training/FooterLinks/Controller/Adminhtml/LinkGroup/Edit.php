<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/8/2016
 * Time: 10:19 AM
 */

namespace Training\FooterLinks\Controller\Adminhtml\LinkGroup;


use Training\FooterLinks\Controller\Adminhtml\GroupAbstract;

class Edit extends GroupAbstract
{
    /**
     * @return void
     */
    public function execute()
    {
        $groupId = $this->getRequest()->getParam('id');

        /** @var \Training\FooterLinks\Model\Link $model */
        $model = $this->_groupFactory->create();

        if ($groupId) {
            $model->load($groupId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This link no longer exists.'));
                $this->_redirect('*/*/index');
                return;
            }
            $this->_coreRegistry->register('group_id',$model->getId());
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Training_FooterLinks::training');
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('New Link Group'));

        return $resultPage;
    }
}