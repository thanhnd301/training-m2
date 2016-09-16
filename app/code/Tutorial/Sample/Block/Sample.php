<?php

namespace Tutorial\Sample\Block;

/**
 * Sample content block
 */
class Sample extends \Magento\Framework\View\Element\Template
{
    /**
     * Sample collection
     *
     * @var Tutorial\Sample\Model\ResourceModel\Sample\Collection
     */
    protected $_sampleCollection = null;
    
    /**
     * Sample factory
     *
     * @var \Tutorial\Sample\Model\SampleFactory
     */
    protected $_sampleCollectionFactory;
    
    /** @var \Tutorial\Sample\Helper\Data */
    protected $_dataHelper;
    
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Tutorial\Sample\Model\ResourceModel\Sample\CollectionFactory $sampleCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Tutorial\Sample\Model\ResourceModel\Sample\CollectionFactory $sampleCollectionFactory,
        \Tutorial\Sample\Helper\Data $dataHelper,
        array $data = []
    ) {
        $this->_sampleCollectionFactory = $sampleCollectionFactory;
        $this->_dataHelper = $dataHelper;
        parent::__construct(
            $context,
            $data
        );
    }
    
    /**
     * Retrieve sample collection
     *
     * @return Tutorial\Sample\Model\ResourceModel\Sample\Collection
     */
    protected function _getCollection()
    {
        $collection = $this->_sampleCollectionFactory->create();
        return $collection;
    }
    
    /**
     * Retrieve prepared sample collection
     *
     * @return Tutorial\Sample\Model\ResourceModel\Sample\Collection
     */
    public function getCollection()
    {
        if (is_null($this->_sampleCollection)) {
            $this->_sampleCollection = $this->_getCollection();
            $this->_sampleCollection->setCurPage($this->getCurrentPage());
            $this->_sampleCollection->setPageSize($this->_dataHelper->getSamplePerPage());
            $this->_sampleCollection->setOrder('published_at','asc');
        }

        return $this->_sampleCollection;
    }
    
    /**
     * Fetch the current page for the sample list
     *
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->getData('current_page') ? $this->getData('current_page') : 1;
    }
    
    /**
     * Return URL to item's view page
     *
     * @param Tutorial\Sample\Model\Sample $sampleItem
     * @return string
     */
    public function getItemUrl($sampleItem)
    {
        return $this->getUrl('*/*/view', array('id' => $sampleItem->getId()));
    }
    
    /**
     * Return URL for resized Sample Item image
     *
     * @param Tutorial\Sample\Model\Sample $item
     * @param integer $width
     * @return string|false
     */
    public function getImageUrl($item, $width)
    {
        return $this->_dataHelper->resize($item, $width);
    }
    
    /**
     * Get a pager
     *
     * @return string|null
     */
    public function getPager()
    {
        $pager = $this->getChildBlock('sample_list_pager');
        if ($pager instanceof \Magento\Framework\Object) {
            $samplePerPage = $this->_dataHelper->getSamplePerPage();

            $pager->setAvailableLimit([$samplePerPage => $samplePerPage]);
            $pager->setTotalNum($this->getCollection()->getSize());
            $pager->setCollection($this->getCollection());
            $pager->setShowPerPage(TRUE);
            $pager->setFrameLength(
                $this->_scopeConfig->getValue(
                    'design/pagination/pagination_frame',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                )
            )->setJump(
                $this->_scopeConfig->getValue(
                    'design/pagination/pagination_frame_skip',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                )
            );

            return $pager->toHtml();
        }

        return NULL;
    }
}
