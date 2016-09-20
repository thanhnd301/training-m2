<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/5/2016
 * Time: 9:23 AM
 */

namespace Training\FooterLinks\Controller\Adminhtml\Link;

use Training\FooterLinks\Controller\Adminhtml\LinkAbstract;

class NewAction extends LinkAbstract
{
    /**
     * Create new news action
     *
     * @return void
     */
    public function execute()
    {
        return $this->_forward('edit');
    }
}