<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/15/2016
 * Time: 9:20 AM
 */

namespace Training\FooterLinks\Ui\Component\Listing\Column\Options;

use Magento\Framework\Option\ArrayInterface;
use Training\FooterLinks\Model\LinkGroupFactory;

class Group implements ArrayInterface
{
    protected $_groupFactory;

    public function __construct(LinkGroupFactory $groupFactory)
    {
        $this->_groupFactory = $groupFactory;
    }

    public function toOptionArray()
    {
        $options = array();
        $model = $this->_groupFactory->create();

        $groups = $model->getCollection()->getData();
        foreach ($groups as $group)
        {
            $options[] = array('value'=>$group['group_id'],'label'=>__($group['title']));
        }

        return $options;
    }
}