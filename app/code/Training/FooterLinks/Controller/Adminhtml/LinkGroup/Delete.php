<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/12/2016
 * Time: 1:56 PM
 */

namespace Training\FooterLinks\Controller\Adminhtml\LinkGroup;

use Training\FooterLinks\Controller\Adminhtml\GroupAbstract;

class Delete extends GroupAbstract
{
    /**
     * @return void
     */
    public function execute()
    {
        $groupId = $this->getRequest()->getParam('id');

        if ($groupId) {
            $model = $this->_groupFactory->create();
            $model->load($groupId);

            if (!$model->getId()) {
                $this->getMessageManager()->addError('This group no longer exists.');
                return;
            }

            try {
                $model->delete();
                $this->getMessageManager()->addSuccess('Delete group success.');
                $this->_redirect('*/*/index');
            } catch (\Exception $e) {
                $this->getMessageManager()->addError($e->getMessage());
                $this->_redirect('*/*/edit', ['id' => $model->getId()]);
            }
        }
    }
}