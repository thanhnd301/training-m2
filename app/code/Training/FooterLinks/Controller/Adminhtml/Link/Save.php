<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/5/2016
 * Time: 10:56 AM
 */

namespace Training\FooterLinks\Controller\Adminhtml\Link;

use Training\FooterLinks\Controller\Adminhtml\LinkAbstract;

class Save extends LinkAbstract
{
    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            try {
                /** @var \Training\FooterLinks\Model\Link $model */
                $model = $this->_linkFactory->create();

                $linkData = $data["footerlink"];
                $linkId = isset($linkData["id"]) ? $linkData["id"]:null;
                if ($linkId) {
                    $link = $model->load($linkId);
                    $linkData = array_merge($link,$linkData);
                }

                // Update time
                $updateTime = date('Y-m-d H:i:s');
                if (!isset($linkData["creation_time"]))
                {
                    $linkData["creation_time"] = $updateTime;
                }
                $linkData["update_time"] = $updateTime;
                $linkData["group_id"] = $this->_getSession()->getGroupId();

                $model->setData($linkData);
                $model->save();

                $this->messageManager->addSuccess(__('Link saved'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    var_dump($model->getData());die("<br/> back");
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/',['linkgroup'=>$this->_getSession()->getGroupId()]);
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the link'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/',['linkgroup'=>$this->_getSession()->getGroupId()]);
    }
}
