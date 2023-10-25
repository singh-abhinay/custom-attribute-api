<?php

namespace Abhinay\ApiOveride\Plugin;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\Product as ProductModel;

/**
 * Class ProductCustomAttribute
 * @package Abhinay\ApiOveride\Plugin
 */
class ProductCustomAttribute
{
    /**
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $subject
     * @param ProductInterface $entity
     * @return ProductInterface
     */
    public function afterGet(
        \Magento\Catalog\Api\ProductRepositoryInterface $subject,
        \Magento\Catalog\Api\Data\ProductInterface $entity
    )
    {
        $product = $entity;
        $extensionAttributes = $product->getExtensionAttributes();
        $clrStatus = $product->getCustomAttribute('clearance_product')->getValue();
        $extensionAttributes->setClearanceProduct($clrStatus);
        $product->setExtensionAttributes($extensionAttributes);
        return $product;
    }
}