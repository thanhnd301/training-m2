<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/14/2016
 * Time: 2:47 PM
 */

namespace Training\SliderWidget\Ui\Component\Form;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Training\SliderWidget\Model\ResourceModel\Banner\CollectionFactory as BannerCollectionFactory;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\App\ObjectManager;

class BannerDataProvider extends AbstractDataProvider
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
     * @param CollectionFactory $bannerCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        BannerCollectionFactory $bannerCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $bannerCollectionFactory->create();
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

        /** @var $group \Training\SliderWidget\Model\Slider */
        foreach ($items as $banner) {
            $this->loadedData[$banner->getId()] = ['general'=>$banner->getData()];
        }

        $data = $this->getSession()->getFormData();
        if (!empty($data)) {
            $bannerId = isset($data['general']['banner_id']) ? $data['general']['banner_id'] : null;
            $this->loadedData[$bannerId] = $data;
            $this->getSession()->unsFormData();
        }

        return $this->loadedData;
    }
}