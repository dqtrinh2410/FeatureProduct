<?php
namespace AHT\FeatureProduct\Model\ResourceModel\FeatureProduct\Grid;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Psr\Log\LoggerInterface as Logger;
use AHT\FeatureProduct\Model\FeatureProduct;

class Collection extends SearchResult
{
    protected $_featureModel;

    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $mainTable,
        $resourceModel = null,
        $identifierName = null,
        $connectionName = null,
        FeatureProduct $featureModel
    ) {
        $this->_featureModel = $featureModel;
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel, $identifierName, $connectionName);
    }

    public function _initSelect()
    {
        parent::_initSelect();
        $this->getSelect()->joinLeft(

        );
    }
}
