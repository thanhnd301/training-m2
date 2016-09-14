<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/7/2016
 * Time: 9:26 AM
 */

namespace Training\FooterLinks\Block\Adminhtml\Edit\Link;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Training\FooterLinks\Block\Adminhtml\Edit\GenericButton;

class BackButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl('linkgroup')),
            'class' => 'back',
            'sort_order' => 10
        ];
    }
}