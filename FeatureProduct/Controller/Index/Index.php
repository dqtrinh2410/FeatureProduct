<?php
namespace AHT\FeatureProduct\Controller\Index;


use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

class Index extends \Magento\Framework\App\Action\Action {
    protected $_productCollection;

    public function __construct(Context $context, \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory)
    {
        parent::__construct($context);
    }

    public function execute()
    {
        // TODO: Implement execute() method.
    }
}
