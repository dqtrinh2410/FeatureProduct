<?php
namespace AHT\FeatureProduct\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH_FEATURE_PRODUCT = 'aht_feature_product/';

    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    public function getFeatureConfig($code, $storeId = null)
    {
        //print_r($this->getConfigValue(self::XML_PATH_FEATURE_PRODUCT .'group_feature_product/'. $code, $storeId));die('id');
        return $this->getConfigValue(self::XML_PATH_FEATURE_PRODUCT .'group_feature_product/'. $code, $storeId);
    }

}
