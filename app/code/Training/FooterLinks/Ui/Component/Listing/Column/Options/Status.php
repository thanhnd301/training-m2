<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 8/30/2016
 * Time: 3:52 PM
 */

namespace Training\FooterLinks\Ui\Component\Listing\Column\Options;
use Magento\Framework\Option\ArrayInterface;

class Status implements ArrayInterface
{
    const ENABLE  = 1;
    const DISABLE = 0;

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            ['value'=>self::ENABLE,'label' => __('Enable')],
            ['value'=>self::DISABLE,'label' => __('Disable')]
        ];

        return $options;
    }
}