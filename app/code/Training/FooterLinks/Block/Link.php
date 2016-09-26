<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/9/2016
 * Time: 11:44 AM
 */

namespace Training\FooterLinks\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Training\FooterLinks\Model\LinkFactory;
use Training\FooterLinks\Model\LinkGroupFactory;

class Link extends Template
{
    protected $_groupFactory;
    protected $_linkFactory;

    public function __construct(
        Context $context,
        array $data,
        LinkFactory $linkFactory,
        LinkGroupFactory $groupFactory
    ){
        parent::__construct($context, $data);
        $this->_groupFactory = $groupFactory;
        $this->_linkFactory = $linkFactory;
    }

    public function getLinks()
    {
        $links = array();
        $groupModel = $this->_groupFactory->create();

        // Get all group allow in this store
        $storeId = $this->_storeManager->getStore()->getId();
        $groupLinkData = $groupModel->getCollection()
            ->addFieldToSelect(['group_id','title'])
            ->addFieldToFilter('is_active',1)
            ->addFieldToFilter('store_id',array(
                array('like'=>'%'.$storeId.'%'),
                array('eq'=>0)
            ))
            ->setOrder('sort_order','asc')
            ->getData();
        if (empty($groupLinkData))
        {
            return '';
        }

        // Get all link in group found
        foreach ($groupLinkData as $group)
        {
            $linkModel = $this->_linkFactory->create();
            $linkData = $linkModel->getCollection()
                ->addFieldToSelect(['title','link'])
                ->addFieldToFilter('status',1)
                ->addFieldToFilter('group_id',$group['group_id'])
                ->setOrder('sort_order','asc')
                ->getData();

            if (empty($linkData))
            {
                continue;
            }
            $links[$group['title']]=array();

            foreach ($linkData as $link)
            {
                $links[$group['title']][] = array(
                    'url'=>$this->getUrl($link['link']),
                    'label'=>$link['title']
                );
            }
        }

        return $links;
    }
}