<?php
namespace AHT\FeatureProduct\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $categorySetupFactory;

    public function __construct(\Magento\Catalog\Setup\CategorySetupFactory $categorySetupFactory) {
        $this->categorySetupFactory = $categorySetupFactory;
    }

    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $categorySetup = $this->categorySetupFactory->create();
        $categorySetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'feature_product',
            [
                'type' => 'int',
                'label' => 'Feature Product',
                'input' => 'select',
                'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                'required' => false,
                'visible_on_front' => true,
                'sort_order' => 105,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'apply_to' =>
                    'simple,configurable,virtual,bundle,downloadable',
                'unique' => false,
            ]
        );
    }
}
