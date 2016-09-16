<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/9/2016
 * Time: 4:49 PM
 */

namespace Training\FooterLinks\Ui\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Training\FooterLinks\Model\ResourceModel\Link\CollectionFactory;
use Magento\Framework\App\Request\Http;

class LinkDataProvider extends AbstractDataProvider
{
    protected $collection;
    protected $request;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        Http $request,
        array $meta = [],
        array $data=[])
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->request = $request;
    }

    public function getData()
    {
        //$groupId = $this->request->getParam('linkgroup');
//        $data = $this->getCollection()->addFieldToFilter('group_id',$groupId)->toArray();
        $data = $this->getCollection()->addFieldToFilter('group_id',1)->toArray();

        return $data;
    }
}