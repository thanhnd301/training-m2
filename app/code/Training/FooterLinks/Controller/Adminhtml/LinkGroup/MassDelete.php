<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/12/2016
 * Time: 2:03 PM
 */

namespace Training\FooterLinks\Controller\Adminhtml\LinkGroup;

use Training\FooterLinks\Controller\Adminhtml\GroupAbstract;

class MassDelete extends GroupAbstract
{
    /**
     * @return void
     */
    public function execute()
    {
        $groupIds = $this->getRequest()->getParam('selected');

        if($groupIds)
        {
            $model = $this->_groupFactory->create();
            $success = 0;
            foreach ($groupIds as $groupId) {
                $model->load($groupId);
                if (!$model->getId())
                {
                    $this->getMessageManager()->addError('The group (id = %1) does not exist.',$groupId);
                }

                try
                {
                    $model->delete();
                    $success++;
                }
                catch (\Exception $e)
                {
                    $this->messageManager->addError($e->getMessage());
                }
            }

            $total = count($groupIds);
            if($total)
            {
                $this->getMessageManager()->addSuccess(
                    __('Delete groups: Total: %1, Success: %2, Fail: %3',
                    $total,$success,$total-$success));
            }
        }

        $this->_redirect('*/*/index');
    }
}