<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/7/2016
 * Time: 9:35 AM
 */

namespace Training\FooterLinks\Block\Adminhtml\Edit\Group;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Training\FooterLinks\Block\Adminhtml\Edit\GenericButton;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        $groupId = $this->_registry->registry('group_id');
        $onlickAction = '';

        if($groupId)
        {
            $onlickAction = 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl($groupId) . '\')';
        }

        return [
            'label' => __('Delete'),
            'class' => 'delete',
            'on_click' => $onlickAction,
            'sort_order' => 20,
        ];
    }
}