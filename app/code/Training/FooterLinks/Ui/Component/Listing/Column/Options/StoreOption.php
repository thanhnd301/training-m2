<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/8/2016
 * Time: 11:24 AM
 */

namespace Training\FooterLinks\Ui\Component\Listing\Column\Options;

use Magento\Store\Model\System\Store as SystemStore;

class StoreOption extends SystemStore
{
    /**
     * All Store Views value
     */
    const ALL_STORE_VIEWS = '0';

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => __('All Store Views'), 'value' => 0];
        $nonEscapableNbspChar = html_entity_decode('&#160;', ENT_NOQUOTES, 'UTF-8');

        foreach ($this->_websiteCollection as $website) {
            $options[] = ['label' => $website->getName(), 'value' => 'website_'.$website->getId()];

            foreach ($this->_groupCollection as $group) {
                if ($website->getId() != $group->getWebsiteId()) {
                    continue;
                }

                foreach ($this->_storeCollection as $store) {
                    if ($group->getId() != $store->getGroupId()) {
                        continue;
                    }

                    $values[] = [
                        'label' => str_repeat($nonEscapableNbspChar, 4) . $store->getName(),
                        'value' => 'store_'.$store->getId(),
                    ];
                }

                $options[] = [
                    'label' => str_repeat($nonEscapableNbspChar, 4) . $group->getName(),
                    'value' => $values,
                ];
                $values=[];
            }
        }
        return $options;
    }
}