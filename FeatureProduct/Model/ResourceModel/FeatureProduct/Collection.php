<?php
namespace AHT\FeatureProduct\Model\ResourceModel\FeatureProduct;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'feature_id';
    protected $_eventPrefix = 'aht_feature_product_collection';
    protected $_eventObject = 'feature_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\FeatureProduct\Model\FeatureProduct', 'AHT\FeatureProduct\Model\ResourceModel\FeatureProduct');
    }

}
