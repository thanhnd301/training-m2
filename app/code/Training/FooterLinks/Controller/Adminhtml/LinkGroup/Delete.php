<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/12/2016
 * Time: 1:56 PM
 */

namespace Training\FooterLinks\Controller\Adminhtml\LinkGroup;

use Training\FooterLinks\Controller\Adminhtml\GroupAbstract;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Training\FooterLinks\Model\LinkGroupFactory;
use Training\FooterLinks\Model\LinkFactory;

class Delete extends GroupAbstract
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
        $groupId = $this->getRequest()->getParam('id');

        if ($groupId) {
            $model = $this->_groupFactory->create();
            $model->load($groupId);

            if (!$model->getId()) {
                $this->getMessageManager()->addError('This group no longer exists.');
                return;
            }

            $this->deleteLink($groupId);

            try {
                $model->delete();
                $this->getMessageManager()->addSuccess('Delete group success.');
                $this->_redirect('*/*/index');
            } catch (\Exception $e) {
                $this->getMessageManager()->addError($e->getMessage());
                $this->_redirect('*/*/edit', ['id' => $model->getId()]);
            }
        }
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