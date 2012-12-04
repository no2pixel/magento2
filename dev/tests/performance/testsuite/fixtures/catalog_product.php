<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Mage_Catalog
 * @subpackage  performance_tests
 * @copyright   Copyright (c) 2012 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

// Extract product set id
$productResource = Mage::getModel('Mage_Catalog_Model_Product');
$entityType = $productResource->getResource()->getEntityType();
$sets = Mage::getResourceModel('Mage_Eav_Model_Resource_Entity_Attribute_Set_Collection')
    ->setEntityTypeFilter($entityType->getId())
    ->load();

$setId = null;
foreach ($sets as $setInfo) {
    $setId = $setInfo->getId();
    break;
}
if (!$setId) {
    throw new Exception('No attributes sets for product found.');
}

// Create product
$product = Mage::getModel('Mage_Catalog_Model_Product');
$product->setTypeId('simple')
    ->setAttributeSetId($setId)
    ->setWebsiteIds(array(1))
    ->setName('Product 1')
    ->setShortDescription('Product 1 Short Description')
    ->setWeight(1)
    ->setDescription('Product 1 Description')
    ->setSku('product_1')
    ->setPrice(10)
    ->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH)
    ->setStatus(Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
    ->setTaxClassId(0)
    ->save()
;

$stockItem = Mage::getModel('Mage_CatalogInventory_Model_Stock_Item');
$stockItem->setProductId($product->getId())
    ->setTypeId($product->getTypeId())
    ->setStockId(Mage_CatalogInventory_Model_Stock::DEFAULT_STOCK_ID)
    ->setIsInStock(1)
    ->setQty(10000)
    ->setUseConfigMinQty(1)
    ->setUseConfigBackorders(1)
    ->setUseConfigMinSaleQty(1)
    ->setUseConfigMaxSaleQty(1)
    ->setUseConfigNotifyStockQty(1)
    ->setUseConfigManageStock(1)
    ->setUseConfigQtyIncrements(1)
    ->setUseConfigEnableQtyInc(1)
    ->save()
;
