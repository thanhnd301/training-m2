<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/12/2016
 * Time: 2:03 PM
 */

namespace Training\FooterLinks\Controller\Adminhtml\LinkGroup;

use Training\FooterLinks\Controller\Adminhtml\GroupAbstract;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Training\FooterLinks\Model\LinkGroupFactory;
use Training\FooterLinks\Model\LinkFactory;

class MassDelete extends GroupAbstract
{
    protected $_linkFactory;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        LinkGroupFactory $groupFactory,
        LinkFactory $linkFactory
    )
    {
        parent::__construct($context, $coreRegistry, $resultPageFactory, $groupFactory);
        $this->_linkFactory = $linkFactory;
    }

    /**
     * @return void
     */
    public function execute()
    {
        $groupIds = $this->getRequest()->getParam('selected');

        if($groupIds)
        {
            $model = $this->_groupFactory->create();
            $success = 0;
            foreach ($groupIds as $groupId) {
                $model->load($groupId);
                if (!$model->getId())
                {
                    $this->getMessageManager()->addError('The group (id = %1) does not exist.',$groupId);
                }

                try
                {
                    $this->deleteLink($groupId);
                    $model->delete();
                    $success++;
                }
                catch (\Exception $e)
                {
                    $this->messageManager->addError($e->getMessage());
                }
            }

            $total = count($groupIds);
            if($total)
            {
                $this->getMessageManager()->addSuccess(
                    __('Delete groups: Total: %1, Success: %2, Fail: %3',
                    $total,$success,$total-$success));
            }
        }

        $this->_redirect('*/*/index');
    }

    private function deleteLink($groupId)
    {
        $model = $this->_linkFactory->create();
        $linkIds = $model->getCollection()->addFieldToFilter('group_id',$groupId)->getAllIds();
        foreach ($linkIds as $linkId)
        {
            try
            {
                $model->load($linkId)->delete();
            }
            catch (\Exception $e)
            {
                continue;
            }
        }
    }

}