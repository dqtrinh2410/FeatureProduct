<?php
namespace AHT\FeatureProduct\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\DataObject\IdentityInterface;

class FeatureProduct extends AbstractDb implements  IdentityInterface{

    const CACHE_TAG = 'aht_feature_product';
    protected $_cacheTag = 'aht_feature_product';
    protected $_eventPrefix = 'aht_feature_product';

    protected function _construct()
    {
        $this->_init('aht_feature_product', 'feature_id');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
