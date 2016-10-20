<?php
/**
 * Created by PhpStorm.
 * User: thanhnd1
 * Date: 20/10/2016
 * Time: 11:03
 */

namespace Training\SimpleAffiliate\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class AffiliateRateType implements ArrayInterface
{
    const FIXED = 1;
    const PERCENT = 2;

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            ['value'=>self::FIXED, 'label'=>__('Fixed')],
            ['value'=>self::PERCENT, 'lable'=>__('Percent')]
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [self::FIXED => __('Fixed'),  self::PERCENT=> __('Percent')];
    }
}