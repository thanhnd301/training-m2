<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/7/2016
 * Time: 9:56 AM
 */

namespace Training\SliderWidget\Block\Adminhtml\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

class GenericButton
{
    protected $_registry;
    protected $_urlBuilder;

    public function __construct(
        Context $context,
        Registry $registry
    ) {
        $this->_urlBuilder = $context->getUrlBuilder();
        $this->_registry = $registry;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    private function getUrl($route = '', $params = [])
    {
        return $this->_urlBuilder->getUrl($route, $params);
    }

    /**
     * Get URL for back (reset) button
     * @param $registerKey
     * @return string
     */
    public function getBackUrl($registerKey=null)
    {
        $param = [];
        if($registerKey)
        {
            $param = [$registerKey => $this->_registry->registry($registerKey)];
        }

        return $this->getUrl('*/*/',$param);
    }

    /**
     * Get URL for delete button
     * @param $id
     * @return string
     */
    public function getDeleteUrl($id)
    {
        return $this->getUrl('*/*/delete', ['id' => $id]);
    }
}