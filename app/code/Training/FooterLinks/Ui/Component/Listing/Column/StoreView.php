<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/8/2016
 * Time: 6:07 PM
 */

namespace Training\FooterLinks\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Store\Model\System\Store as SystemStore;

class StoreView extends Column
{
    /**
     * System store
     *
     * @var SystemStore
     */
    protected $systemStore;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = [],
        SystemStore $systemStore
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->systemStore = $systemStore;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item[$this->getData('name')] = $this->prepareItem($item);
            }
        }
        return $dataSource;
    }

    protected function prepareItem(array $item)
    {
        $content = '';
        if (!isset($item['store_id']) || '' == $item['store_id']) {
            return '';
        }

        $storeIds = explode(',',$item['store_id']);
        if (in_array(0, $storeIds)) {
            return __('All Store Views');
        }

        $data = $this->systemStore->getStoresStructure(false, $storeIds);
        $nonEscapableNbspChar = html_entity_decode('&#160;', ENT_NOQUOTES, 'UTF-8');

        foreach ($data as $website) {
            $content .= $website['label'] . "<br/>";
            foreach ($website['children'] as $group) {
                $content .= str_repeat($nonEscapableNbspChar, 3).$group['label'] . "<br/>";
                foreach ($group['children'] as $store) {
                    $content .= str_repeat($nonEscapableNbspChar, 6).$store['label'] . "<br/>";
                }
            }
        }

        return $content;
    }
}