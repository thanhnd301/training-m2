<?php

namespace Tutorial\Sample\Controller\AbstractController;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;

interface SampleLoaderInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return \Tutorial\Sample\Model\Sample
     */
    public function load(RequestInterface $request, ResponseInterface $response);
}
