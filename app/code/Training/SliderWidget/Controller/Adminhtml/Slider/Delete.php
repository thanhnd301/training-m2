<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/13/2016
 * Time: 4:52 PM
 */

namespace Training\SliderWidget\Controller\Adminhtml\Slider;

use Training\SliderWidget\Controller\Adminhtml\SliderAbstract;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Training\SliderWidget\Model\SliderFactory;
use Training\SliderWidget\Model\BannerFactory;

class Delete extends SliderAbstract
{
    protected $_bannerFactory;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        SliderFactory $sliderFactory,
        BannerFactory $bannerFactory
    )
    {
        parent::__construct($context, $coreRegistry, $resultPageFactory, $sliderFactory);
        $this->_linkFactory = $bannerFactory;
    }

    /**
     * @return void
     */
    public function execute()
    {
        $sliderId = $this->getRequest()->getParam('id');

        if ($sliderId) {
            $model = $this->_sliderFactory->create();

            if (!$model->getId()) {
                $this->getMessageManager()->addError('This group no longer exists.');
                return;
            }

            $this->deleteBanner($sliderId);

            try {
                $model->delete();
                $this->getMessageManager()->addSuccess('Delete slider success.');
                $this->_redirect('*/*/index');
            } catch (\Exception $e) {
                $this->getMessageManager()->addError($e->getMessage());
                $this->_redirect('*/*/edit', ['id' => $model->getId()]);
            }
        }
    }

    private function deleteBanner($sliderId)
    {
        $model = $this->_bannerFactory->create();
        $bannerIds = $model->getCollection()->addFieldToFilter('slider_id',$sliderId)->getAllIds();
        foreach ($bannerIds as $bannerId)
        {
            try
            {
                $model->load($bannerId)->delete();
            }
            catch (\Exception $e)
            {
                continue;
            }
        }
    }
}