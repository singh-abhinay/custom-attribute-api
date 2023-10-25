<?php

declare(strict_types=1);

namespace Abhinay\ApiOveride\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Type;
use Psr\Log\LoggerInterface;

/**
 * Class SampleAttribute
 * @package Abhinay\ApiOveride\Setup\Patch\Data
 */
class SampleAttribute implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * SampleAttribute constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory,
        LoggerInterface $logger
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->logger = $logger;
    }

    /**
     * Applying Patch for creating new product attribute
     */
    public function apply()
    {
        try {
            $productTypes = implode(',', [Type::TYPE_SIMPLE, Type::TYPE_VIRTUAL]);
            $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
            $eavSetup->addAttribute(Product::ENTITY, 'clearance_product', [
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label' => 'Clearance Product',
                'input' => 'boolean',
                'class' => '',
                'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => $productTypes
            ]);
        } catch (\Exception $e) {
            $this->logger->critical($e);
        }
    }

    /**
     * @return array
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getAliases(): array
    {
        return [];
    }
}