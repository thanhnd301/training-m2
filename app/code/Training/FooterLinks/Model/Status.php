<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 8/30/2016
 * Time: 3:52 PM
 */

namespace Training\FooterLinks\Model;
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
            ['value'=>self::ENABLE,'label' => __('Active')],
            ['value'=>self::DISABLE,'label' => __('Inactive')]
        ];

        return $options;
    }
}