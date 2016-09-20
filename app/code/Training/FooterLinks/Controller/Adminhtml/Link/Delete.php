<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/8/2016
 * Time: 8:43 AM
 */

namespace Training\FooterLinks\Controller\Adminhtml\Link;


use Training\FooterLinks\Controller\Adminhtml\LinkAbstract;

class Delete extends LinkAbstract
{
    /**
     * @return void
     */
    public function execute()
    {
        $linkId = (int)$this->getRequest()->getParam('id');

        if($linkId)
        {
            $model = $this->_linkFactory->create();
            $model->load($linkId);

            if(!$model->getId())
            {
                $this->messageManager->addError(__('This link no longer exists.'));
                return;
            }

            try
            {
                $model->delete();
                $this->messageManager->addSuccess(__('The link has been deleted.'));

                $this->_redirect('*/*/index');
            }
            catch (\Exception $e)
            {
                $this->getMessageManager()->addError($this->__($e->getMessage()));
                $this->_redirect('*/*/edit',['id'=>$model->getId()]);
            }
        }
    }
}