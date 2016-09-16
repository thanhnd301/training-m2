<?php
/**
 * Adminhtml sample list block
 *
 */
namespace Tutorial\Sample\Block\Adminhtml;

class Sample extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_sample';
        $this->_blockGroup = 'Tutorial_Sample';
        $this->_headerText = __('Sample');
        $this->_addButtonLabel = __('Add New Sample');
        parent::_construct();
        if ($this->_isAllowedAction('Tutorial_Sample::save')) {
            $this->buttonList->update('add', 'label', __('Add New Sample'));
        } else {
            $this->buttonList->remove('add');
        }
    }
    
    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
