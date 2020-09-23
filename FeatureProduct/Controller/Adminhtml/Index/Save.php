<?php
namespace AHT\FeatureProduct\Controller\Adminhtml\Index;

class Save extends \Magento\Backend\App\Action
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
    }

    protected function _isActive()
    {
        return $this->authorization->isAllowed('AHT_FeatureProduct::save');
    }
}

