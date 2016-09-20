<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/15/2016
 * Time: 4:13 PM
 */

namespace Training\SliderWidget\Block\Adminhtml\Edit\Tab;

class Banners extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    protected $collectionFactory;
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Training\SliderWidget\Model\ResourceModel\Banner\CollectionFactory $collectionFactory,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('slider_banners_grid');
        $this->setDefaultSort('banner_id', 'asc');
        $this->setUseAjax(true);
    }

    /**
     * Apply various selection filters to prepare the sales order grid collection.
     *
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_collectionFactory->create()->addFieldToSelect('*');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * {@inheritdoc}
     */
    protected function _prepareColumns()
    {
        $this->addColumn('banner_id', ['header' => __('Banner'), 'width' => '100', 'index' => 'banner_id']);

        $this->addColumn('title', ['header' => __('Title'), 'index' => 'title']);

        return parent::_prepareColumns();
    }
}