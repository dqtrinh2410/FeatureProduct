<?php
namespace AHT\FeatureProduct\Controller\Adminhtml\Index;

use AHT\FeatureProduct\Model\ResourceModel\FeatureProduct as FeatureResource;

class Edit extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Index';

    protected $_resultPageFactory;
    protected $_featureProductFactory;
    protected $_productFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \AHT\FeatureProduct\Model\FeatureProductFactory $featureProductFactory,
        \Magento\Catalog\Model\ProductFactory $productFactory
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_featureProductFactory = $featureProductFactory;
        $this->_productFactory = $productFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('AHT_HelloWorld::component');
        $resultPage->addBreadcrumb(__('HelloWorld'), __('HelloWorld'));
        $resultPage->addBreadcrumb(__('Components'), __('Components'));
        $feature_id = $this->getRequest()->getParam('feature_id');
        //die($feature_id);
        $productId = $this->_featureProductFactory->create()->load($feature_id)->getEntityId();
//        die($productId);
        //print_r($this->_productFactory->create()->load($feature_id)->getData());die();
        $product = $this->_productFactory->create()->load($productId);
        $resultPage->getConfig()->getTitle()->prepend(__($product->getName()));
        return $resultPage;
    }

    protected function _isActive()
    {
        return $this->authorization->isAllowed('AHT_FeatureProduct::edit');
    }
}

