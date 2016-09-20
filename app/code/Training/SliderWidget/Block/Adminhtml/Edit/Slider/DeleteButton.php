<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/7/2016
 * Time: 9:35 AM
 */

namespace Training\SliderWidget\Block\Adminhtml\Edit\Slider;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Training\FooterLinks\Block\Adminhtml\Edit\GenericButton;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        $sliderId = $this->_registry->registry('slider_id');
        $onlickAction = '';

        if($sliderId)
        {
            $onlickAction = 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl($sliderId) . '\')';
        }

        return [
            'label' => __('Delete'),
            'class' => 'delete',
            'on_click' => $onlickAction,
            'sort_order' => 20,
        ];
    }
}