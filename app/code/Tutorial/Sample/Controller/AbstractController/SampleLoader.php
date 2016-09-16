<?php

namespace Tutorial\Sample\Controller\AbstractController;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;

class SampleLoader implements SampleLoaderInterface
{
    /**
     * @var \Tutorial\Sample\Model\SampleFactory
     */
    protected $sampleFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $url;

    /**
     * @param \Tutorial\Sample\Model\SampleFactory $sampleFactory
     * @param OrderViewAuthorizationInterface $orderAuthorization
     * @param Registry $registry
     * @param \Magento\Framework\UrlInterface $url
     */
    public function __construct(
        \Tutorial\Sample\Model\SampleFactory $sampleFactory,
        Registry $registry,
        \Magento\Framework\UrlInterface $url
    ) {
        $this->sampleFactory = $sampleFactory;
        $this->registry = $registry;
        $this->url = $url;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return bool
     */
    public function load(RequestInterface $request, ResponseInterface $response)
    {
        $id = (int)$request->getParam('id');
        if (!$id) {
            $request->initForward();
            $request->setActionName('noroute');
            $request->setDispatched(false);
            return false;
        }

        $sample = $this->sampleFactory->create()->load($id);
        $this->registry->register('current_sample', $sample);
        return true;
    }
}
