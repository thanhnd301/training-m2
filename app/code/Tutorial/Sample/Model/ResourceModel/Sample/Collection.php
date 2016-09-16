<?php

/**
 * Sample Resource Collection
 */
namespace Tutorial\Sample\Model\ResourceModel\Sample;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tutorial\Sample\Model\Sample', 'Tutorial\Sample\Model\ResourceModel\Sample');
    }
}
