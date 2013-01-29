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
 * @category    Mage
 * @package     Mage_Sales
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/* @var $installer Mage_Sales_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$installer->getConnection()
    ->modifyColumn($installer->getTable('sales_flat_quote_payment'), 'cc_exp_year',
        array(
            'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
            'length'      => 255,
            'nullable'  => true,
            'default'   => null,
            'comment'   => 'Cc Exp Year'
        )
    )->modifyColumn($installer->getTable('sales_flat_quote_payment'), 'cc_exp_month',
        array(
            'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
            'length'      => 255,
            'nullable'  => true,
            'default'   => null,
            'comment'   => 'Cc Exp Month'
        )
    );

$installer->endSetup();
