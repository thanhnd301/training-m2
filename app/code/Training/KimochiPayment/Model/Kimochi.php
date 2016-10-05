<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Training\KimochiPayment\Model;



/**
 * Pay In Store payment method model
 */
class Kimochi extends \Magento\Payment\Model\Method\AbstractMethod
{

    /**
     * Payment code
     *
     * @var string
     */
    protected $_code = 'kimochi';

    /**
     * Availability option
     *
     * @var bool
     */
    protected $_isOffline = true;


  

}
