<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/15/2016
 * Time: 9:39 AM
 */

namespace Training\SliderWidget\Controller\Adminhtml\Banner;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\LayoutFactory;
use Training\SliderWidget\Controller\Adminhtml\BannerAbstract;
use Training\SliderWidget\Model\BannerFactory;
use Training\SliderWidget\Model\ImageUploader;

class Save extends BannerAbstract
{
    protected $imageUploader;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        LayoutFactory $resultLayoutFactory,
        ImageUploader $imageUploader,
        BannerFactory $bannerFactory)
    {
        parent::__construct($context, $coreRegistry, $resultPageFactory, $resultLayoutFactory, $bannerFactory);
        $this->imageUploader = $imageUploader;
    }

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

                // Save image
                $image = $this->_uploadImage('image');
                if($image)
                {
                    $bannerData['image'] = $image;
                }

                $bannerId = isset($bannerData["id"]) ? $bannerData["id"]:null;
                if ($bannerId) {
                    $banner = $model->load($bannerId)->getData();
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

    private function _uploadImage($scope)
    {
        $this->__prepareImage();

        $adapter = $this->_objectManager->create('Magento\Framework\HTTP\Adapter\FileTransferFactory')->create();
        if ($adapter->isUploaded($scope))
        {
            if (!$adapter->isValid($scope)) {
                throw new \Magento\Framework\Model\Exception(__('Uploaded image is not valid.'));
            }

            $uploader = $this->_objectManager->create('Magento\MediaStorage\Model\File\UploaderFactory')
                ->create(['fileId' => $scope]);

            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(false);
            $uploader->setAllowCreateFolders(true);

            $path = $this->_objectManager->create('Magento\Framework\Filesystem');
            $path = $path->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)
                ->getAbsolutePath('sliderwidget');

            if ($uploader->save($path)) {
                return $uploader->getUploadedFileName();
            }
            return false;
        }
    }

    private function __prepareImage()
    {
        $imageInfo = [
            'name'=>$_FILES['general']['name']['image'],
            'type'=>$_FILES['general']['type']['image'],
            'tmp_name'=>$_FILES['general']['tmp_name']['image'],
            'error'=>$_FILES['general']['error']['image'],
            'size'=>$_FILES['general']['size']['image']
        ];

        $_FILES = ['image'=>$imageInfo];
    }
}