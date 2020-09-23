<?php
namespace AHT\FeatureProduct\Model\FeatureProduct;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use AHT\FeatureProduct\Model\ResourceModel\FeatureProduct\Collection as FeatureCollection;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Catalog\Ui\DataProvider\Product\ProductDataProvider;

class FeatureDataProvider extends ProductDataProvider
{
    protected $_productCollection;
    protected $featureCollection;
    protected $collection;

//    public function __construct(
//        $name,
//        $primaryFieldName,
//        $requestFieldName,
//        ReportingInterface $reporting,
//        SearchCriteriaBuilder $searchCriteriaBuilder,
//        RequestInterface $request,
//        FilterBuilder $filterBuilder,
//        FeatureCollection $featureCollection,
//        ProductCollectionFactory $productCollectionFactory,
//        array $meta = [],
//        array $data = []
//    ) {
//        $this->collection = $featureCollection;
//        $this->_productCollection = $productCollectionFactory->create();
//        parent::__construct($name, $primaryFieldName, $requestFieldName, $reporting, $searchCriteriaBuilder, $request, $filterBuilder, $meta, $data);
//    }

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $addFieldStrategies = [],
        array $addFilterStrategies = [],
        array $meta = [],
        array $data = [],
        PoolInterface $modifiersPool = null,
        FeatureCollection $featureCollection,
        ProductCollectionFactory $productCollectionFactory
    ) {
        $this->collection = $productCollectionFactory->create();
        $this->featureCollection = $featureCollection;
        $this->_productCollection = $productCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName ,$collectionFactory, $addFieldStrategies, $addFilterStrategies, $meta, $data, $modifiersPool);
    }


     public function getData()
     {
         $arrayItems = [];
         $arrayItems['items']= [];
         $arrayItems['totalRecords'] = $this->featureCollection->count();
         foreach ($this->featureCollection->getData() as $featureProduct) {
             $arrayData['feature_id'] = '';
             $arrayData = $this->_productCollection
                                 ->addAttributeToSelect('*')
                                 ->getItemByColumnValue('entity_id',$featureProduct['entity_id'])
                                 ->getData();
             $arrayData['feature_id'] = $featureProduct['feature_id'];
             array_push($arrayItems['items'],$arrayData);
         }
         return $arrayItems;
    }
}
