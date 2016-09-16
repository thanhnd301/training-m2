<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/14/2016
 * Time: 2:00 PM
 */

namespace Training\SliderWidget\Ui\Component\Listing\Column\Options;

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