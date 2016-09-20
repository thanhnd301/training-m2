<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/8/2016
 * Time: 10:06 AM
 */

namespace Training\FooterLinks\Controller\Adminhtml\LinkGroup;


use Training\FooterLinks\Controller\Adminhtml\GroupAbstract;

class NewAction extends GroupAbstract
{
    /**
     * @return forward edit action
     */
    public function execute()
    {
        return $this->_forward('edit');
    }

}