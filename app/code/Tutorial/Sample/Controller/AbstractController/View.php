<?php

namespace Tutorial\Sample\Controller\AbstractController;

use Magento\Framework\App\Action;
use Magento\Framework\View\Result\PageFactory;

abstract class View extends Action\Action
{
    /**
     * @var \Tutorial\Sample\Controller\AbstractController\SampleLoaderInterface
     */
    protected $sampleLoader;
	
	/**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param OrderLoaderInterface $orderLoader
	 * @param PageFactory $resultPageFactory
     */
    public function __construct(Action\Context $context, SampleLoaderInterface $sampleLoader, PageFactory $resultPageFactory)
    {
        $this->sampleLoader = $sampleLoader;
		$this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Sample view page
     *
     * @return void
     */
    public function execute()
    {
        if (!$this->sampleLoader->load($this->_request, $this->_response)) {
            return;
        }

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
		return $resultPage;
    }
}
