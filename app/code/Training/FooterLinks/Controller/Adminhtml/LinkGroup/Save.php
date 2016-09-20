<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/8/2016
 * Time: 1:54 PM
 */

namespace Training\FooterLinks\Controller\Adminhtml\LinkGroup;


use Training\FooterLinks\Controller\Adminhtml\GroupAbstract;

class Save extends GroupAbstract
{
    /**
     * @return void
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            try {
                /** @var \Training\FooterLinks\Model\Link $model */
                $model = $this->_groupFactory->create();

                $groupData = $data["general"];
                $groupId = isset($groupData["group_id"]) ? $groupData["group_id"]:null;

                // Check the same title
                $group = $model->load($groupData['title'],'title')->getData();
                if($group && !$groupId)
                {
                    $this->messageManager->addError('This group already exists.');
                    $this->_redirect('*/*/new', ['_current' => true]);
                    return;
                }

                // Merge form data and db data
                if ($groupId) {
                    $group = $model->load($groupId)->getData();
                    $groupData = array_merge($group,$groupData);
                }

                // Update time
                $updateTime = date('Y-m-d H:i:s');
                if (!isset($groupData["creation_time"]))
                {
                    $groupData["creation_time"] = $updateTime;
                }
                $groupData["update_time"] = $updateTime;

                $groupData['store_id'] = implode(',',$groupData['store_id']);

                $model->setData($groupData);
                $model->save();

                $this->messageManager->addSuccess(__('Group saved'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    var_dump($model->getData());die("<br/> back");
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the group'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}