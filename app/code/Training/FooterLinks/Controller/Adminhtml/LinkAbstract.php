<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/5/2016
 * Time: 9:25 AM
 */

namespace Training\FooterLinks\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Training\FooterLinks\Model\LinkFactory;

abstract class LinkAbstract extends Action
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
     * @var \Training\FooterLinks\Model\LinkFactory
     */
    protected $_linkFactory;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     * @param LinkFactory $linkFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        LinkFactory $linkFactory
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_linkFactory = $linkFactory;
    }

    /**
     * News access rights checking
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Training_FooterLinks::footerlinks_linkgroup');
    }
}