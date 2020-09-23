<?php
namespace AHT\FeatureProduct\Controller\Adminhtml\Index;

use AHT\FeatureProduct\Model\ResourceModel\FeatureProduct as FeatureResource;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Index';

    protected $_featureProductFactory;
    protected $_featureProductResource;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \AHT\FeatureProduct\Model\FeatureProductFactory $featureProductFactory,
        FeatureResource $featureResource
    ) {
        $this->_featureProductFactory = $featureProductFactory;
        $this->_featureProductResource = $featureResource;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $feature_id = $this->getRequest()->getParam('feature_id');
            $feature = $this->_featureProductFactory->create()->load($feature_id);
            $this->_featureProductResource->delete($feature);
        } catch (\Exception $e) {
            $this->messageManager->addError(__('Unable to process. please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/', array('_current' => true));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }

    protected function _isActive()
    {
        return $this->authorization->isAllowed('AHT_FeatureProduct::delete');
    }
}

