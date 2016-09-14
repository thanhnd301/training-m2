<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/13/2016
 * Time: 2:21 PM
 */

namespace Training\SliderWidget\Ui\Component\Listing\Column\Options;

use Magento\Framework\Option\ArrayInterface;

class IsActive implements ArrayInterface
{
    const ACTIVE  = 1;
    const INACTIVE = 0;

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            ['value'=>self::ACTIVE,'label' => __('Active')],
            ['value'=>self::INACTIVE,'label' => __('Inactive')]
        ];

        return $options;
    }
}