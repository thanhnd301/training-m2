<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/8/2016
 * Time: 9:46 AM
 */

namespace Training\FooterLinks\Controller\Adminhtml\Link;


use Training\FooterLinks\Controller\Adminhtml\LinkAbstract;

class MassDelete extends LinkAbstract
{
    /**
     * @return void
     */
    public function execute()
    {
        $linkIds = $this->getRequest()->getParam('selected');

        if($linkIds)
        {
            $model = $this->_linkFactory->create();

            foreach($linkIds as $linkId)
            {
                try
                {
                    $model->load($linkId)->delete();
                }
                catch (\Exception $e)
                {
                    $this->messageManager->addError($e->getMessage());
                }
            }

            if (count($linkIds)) {
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) were deleted.', count($linkIds))
                );
            }

        }

        $this->_redirect('*/*/index');
    }
}