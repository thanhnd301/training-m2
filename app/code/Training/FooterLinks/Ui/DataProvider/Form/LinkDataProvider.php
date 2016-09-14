<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/5/2016
 * Time: 4:43 PM
 */

namespace Training\FooterLinks\Ui\DataProvider\Form;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Training\FooterLinks\Model\ResourceModel\Link\CollectionFactory as LinkCollectionFactory;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\App\ObjectManager;

class LinkDataProvider extends AbstractDataProvider
{
    /**
     * @var \Magento\Cms\Model\ResourceModel\Page\Collection
     */
    protected $collection;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var SessionManagerInterface
     */
    protected $session;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $linkCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        LinkCollectionFactory $linkCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $linkCollectionFactory->create();
    }

    /**
     * Get session object
     *
     * @return SessionManagerInterface
     */
    protected function getSession()
    {
        if ($this->session === null) {
            $this->session = ObjectManager::getInstance()->get('Magento\Framework\Session\SessionManagerInterface');
        }
        return $this->session;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var $link \Training\FooterLinks\Model\Link */
        foreach ($items as $link) {
            $this->loadedData[$link->getId()] = ['footerlink'=>$link->getData()];
        }

        $data = $this->getSession()->getFormData();
        if (!empty($data)) {
            $linkId = isset($data['footerlink']['link_id']) ? $data['footerlink']['link_id'] : null;
            $this->loadedData[$linkId] = $data;
            $this->getSession()->unsFormData();
        }

        return $this->loadedData;
    }
}