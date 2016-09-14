<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/13/2016
 * Time: 12:07 PM
 */

namespace Training\SliderWidget\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Training\SliderWidget\Model\BannerFactory;

abstract class BannerAbstract extends Action
{
    /**
     * Core session
     *
     * @var \Magento\Backend\Model\Session
     */
    protected $_coreSession;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * Result page factory
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * News model factory
     *
     * @var \Training\FooterLinks\Model\BannerFactory
     */
    protected $_bannerFactory;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     * @param BannerFactory $bannerFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        BannerFactory $bannerFactory
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_bannerFactory = $bannerFactory;
    }

    /**
     * News access rights checking
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Training_SliderWidget::sliderwidget_slider');
    }
}