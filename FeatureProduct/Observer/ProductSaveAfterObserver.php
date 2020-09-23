<?php
namespace AHT\FeatureProduct\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use AHT\FeatureProduct\Model\ResourceModel\FeatureProduct as FeatureResource;
use AHT\FeatureProduct\Model\ResourceModel\FeatureProduct\Collection as FeatureCollection;

use Magento\Framework\Exception\AlreadyExistsException;

class ProductSaveAfterObserver implements  ObserverInterface{

    protected $logger;
    protected $_featureProductFactory;
    protected $_featureResource;
    protected $_featureCollection;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \AHT\FeatureProduct\Model\FeatureProductFactory $featureProductFactory,
        FeatureResource $featureResource,
        FeatureCollection $featureCollection
    ) {
        $this->logger = $logger;
        $this->_featureProductFactory = $featureProductFactory;
        $this->_featureResource = $featureResource;
        $this->_featureCollection = $featureCollection;
    }
    public function execute(Observer $observer)
    {
        $product = $observer->getProduct();
        $featureProduct = $this->_featureProductFactory->create()
                            ->getCollection()
                            ->getItemByColumnValue('entity_id', $product->getId());
        if (!$featureProduct && $product->getFeatureProduct() == 1) {
            try {
                $featureSave = $this->_featureProductFactory->create();
                $featureSave->setEntityId($product->getId());
                //print_r($featureSave->getData());die();
                $this->_featureResource->save($featureSave);
            } catch (\Exception $e) {

            }
        } elseif ($featureProduct && $product->getFeatureProduct() == 0) {
            try {
                $this->_featureResource->delete($featureProduct);
            } catch (\Exception $e) {

            }
        }
    }
}
