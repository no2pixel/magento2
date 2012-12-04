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
 * @package     Mage_Sales
 * @subpackage  integration_tests
 * @copyright   Copyright (c) 2012 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

$addressData = array(
    'region'     => 'CA',
    'postcode'   => '11111',
    'street'     => 'street',
    'city'       => 'Los Angeles',
    'telephone'  => '11111111',
    'country_id' => 'US',
);
$billingAddress = Mage::getModel('Mage_Sales_Model_Order_Address', $addressData);
$shippingAddress = clone $billingAddress;

$item = Mage::getModel('Mage_Sales_Model_Order_Item');
$item->setOriginalPrice(100)
    ->setPrice(100)
    ->setQtyOrdered(1)
    ->setRowTotal(100)
    ->setSubtotal(100);

$payment = Mage::getModel('Mage_Sales_Model_Order_Payment');
$payment->setMethod('checkmo');

$order = Mage::getModel('Mage_Sales_Model_Order');
$order->setBaseSubtotal(100)
    ->setSubtotal(100)
    ->setBaseGrandTotal(100)
    ->setGrandTotal(100)
    ->setTotalPaid(100)
    ->setCustomerIsGuest(true)
    ->setState(Mage_Sales_Model_Order::STATE_NEW, true)
    ->setStoreId(Mage::app()->getStore()->getId());

for ($i = 1; $i <= 100000; $i++) {
    $billingAddress
        ->setId(null)
        ->setFirstname("Name $i")
        ->setLastname("Lastname $i")
        ->setEmail("customer$i@example.com");
    $shippingAddress
        ->setId(null)
        ->setFirstname("Name $i")
        ->setLastname("Lastname $i")
        ->setEmail("customer$i@example.com");

    $item
        ->setId(null)
        ->setSku("item$i");

    $payment->setId(null);

    $order->setId(null);

    $order->getItemsCollection()->removeAllItems();
    $order->getAddressesCollection()->removeAllItems();
    $order->getPaymentsCollection()->removeAllItems();

    $order
        ->setIncrementId((string)(10000000 + $i))
        ->setCreatedAt(date('Y-m-d H:i:s'))
        ->setCustomerEmail("customer$i@example.com")
        ->setBillingAddress($billingAddress)
        ->setShippingAddress($shippingAddress)
        ->addItem($item)
        ->setPayment($payment);

    $order->save();
}
