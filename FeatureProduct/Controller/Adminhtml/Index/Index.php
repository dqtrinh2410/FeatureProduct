<?php
namespace AHT\FeatureProduct\Controller\Adminhtml\Index;

class Index extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Index';

    protected $_resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('AHT_HelloWorld::component');
        $resultPage->addBreadcrumb(__('HelloWorld'), __('HelloWorld'));
        $resultPage->addBreadcrumb(__('Components'), __('Components'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Feature Product'));
        return $resultPage;
    }

    protected function _isActive()
    {
        return $this->authorization->isAllowed('AHT_FeatureProduct::index');
    }
}

