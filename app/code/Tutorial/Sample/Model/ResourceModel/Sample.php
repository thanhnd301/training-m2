<?php

namespace Tutorial\Sample\Model\ResourceModel;

/**
 * Sample Resource Model
 */
class Sample extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('tutorial_sample', 'sample_id');
    }
}
