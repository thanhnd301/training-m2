<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/15/2016
 * Time: 9:39 AM
 */

namespace Training\SliderWidget\Controller\Adminhtml\Banner;

use Training\SliderWidget\Controller\Adminhtml\BannerAbstract;

class Save extends BannerAbstract
{
    /**
     * @return void
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if($data)
        {
            try {
                /** @var \Training\FooterLinks\Model\Link $model */
                $model = $this->_bannerFactory->create();

                $bannerData = $data["general"];
                $bannerId = isset($bannerData["id"]) ? $bannerData["id"]:null;

                if ($bannerId) {
                    $banner = $model->load($bannerId);
                    $bannerData = array_merge($banner,$bannerData);
                }

                // Update time
                $updateTime = date('Y-m-d H:i:s');
                if (!isset($bannerData["creation_time"]))
                {
                    $bannerData["creation_time"] = $updateTime;
                }
                $bannerData["update_time"] = $updateTime;

                $model->setData($bannerData);
                $model->save();

                $this->messageManager->addSuccess(__('Banner saved'));
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
                $this->messageManager->addException($e, __('Something went wrong while saving the banner'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}