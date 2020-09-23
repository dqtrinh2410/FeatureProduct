<?php
namespace AHT\FeatureProduct\Block\FeatureProduct;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\Product\Visibility;
use Magento\CatalogWidget\Model\Rule;
use Magento\Framework\App\Http\Context;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Url\EncoderInterface;
use Magento\Framework\View\LayoutFactory;
use Magento\Rule\Model\Condition\Sql\Builder;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\View\Element\Template;
use AHT\FeatureProduct\Model\ResourceModel\FeatureProduct\CollectionFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Catalog\Model\ProductFactory;
use AHT\FeatureProduct\Helper\Data;
use Magento\CatalogWidget\Block\Product\ProductsList;
use Magento\Widget\Helper\Conditions;

class FeatureProduct extends Template implements BlockInterface
{
    protected $_collection;
    protected $_productCollectionFactory;
    protected $_helper;
    protected $_storeManager;
    protected $_product;

    public function __construct(
        Template\Context $context,
        array $data = [],
        CollectionFactory $collectionFactory,
        ProductCollectionFactory $productCollectionFactory,
        ProductFactory $productFactory,
        Data $helper
    ) {
        $this->_helper = $helper;
        $this->_product = $productFactory->create();
        $this->_collection = $collectionFactory->create();
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context, $data);
    }
//
    public function getProductData($numberDisplay) {
        $arrayData = [];
        //print_r($this->_collection->getData());die();
        $listFeature = $this->_collection->setPageSize($numberDisplay);
        $listProduct = $this->_productCollectionFactory->create();
        foreach ($listFeature as $feature) {
            $entity_id = $feature->getEntityId();
//            array_push(
//                $arrayData,
//                $listProduct->addAttributeToSelect('*')
//                    ->getItemByColumnValue( 'entity_id',$entity_id)
//                    ->getData()
//            );
            $listProduct->addAttributeToSelect('*')
                    ->addAttributeToFilter('child_id')
                    ->getData();
        }

        //print_r($arrayData);die();
        return $arrayData;
    }

    public function getStoreManager() {
        return $this->_storeManager;
    }

    public function getHelper() {
        return $this->_helper;
    }

    public function getProductLink($entity_id) {
        return $this->escapeUrl($this->_product->load($entity_id)->getProductUrl());
    }
}
