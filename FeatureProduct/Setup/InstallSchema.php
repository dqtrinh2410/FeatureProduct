<?php
namespace AHT\FeatureProduct\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('aht_feature_product')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('aht_feature_product')
            )
                ->addColumn(
                    'feature_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Feature ID'
                )
                ->addColumn(
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    [
                        'nullable' => false,
                        'unsigned' => true,
                    ],
                    'Entity ID'
                )
                ->setComment('Feature Product Table');
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
