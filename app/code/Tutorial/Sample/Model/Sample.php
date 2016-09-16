<?php

namespace Tutorial\Sample\Model;

/**
 * Sample Model
 *
 * @method \Tutorial\Sample\Model\Resource\Page _getResource()
 * @method \Tutorial\Sample\Model\Resource\Page getResource()
 */
class Sample extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tutorial\Sample\Model\ResourceModel\Sample');
    }

}
