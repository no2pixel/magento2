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
 * @package     Mage_Backend
 * @subpackage  integration_tests
 * @copyright   Copyright (c) 2012 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Test class for Mage_Backend_Block_Widget
 *
 * @group module:Mage_Backend
 */
class Mage_Backend_Block_WidgetTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers Mage_Backend_Block_Widget::getButtonHtml
     */
    public function testGetButtonHtml()
    {
        $layout = Mage::getModel('Mage_Core_Model_Layout', array('area' => Mage_Core_Model_App_Area::AREA_ADMINHTML));
        $layout->getUpdate()->load();
        $layout->generateXml()->generateElements();

        $widget = $layout->createBlock('Mage_Backend_Block_Widget');

        $this->assertRegExp(
            '/<button.*onclick\=\"this.form.submit\(\)\".*\>[\s\S]*Button Label[\s\S]*<\/button>/iu',
            $widget->getButtonHtml('Button Label', 'this.form.submit()')
        );
    }

    /**
     * Case when two buttons will be created in same parent block
     *
     * @covers Mage_Backend_Block_Widget::getButtonHtml
     */
    public function testGetButtonHtmlForTwoButtonsInOneBlock()
    {
        $layout = Mage::getModel('Mage_Core_Model_Layout', array('area' => Mage_Core_Model_App_Area::AREA_ADMINHTML));
        $layout->getUpdate()->load();
        $layout->generateXml()->generateElements();

        $widget = $layout->createBlock('Mage_Backend_Block_Widget');

        $this->assertRegExp(
            '/<button.*onclick\=\"this.form.submit\(\)\".*\>[\s\S]*Button Label[\s\S]*<\/button>/iu',
            $widget->getButtonHtml('Button Label', 'this.form.submit()')
        );

        $this->assertRegExp(
            '/<button.*onclick\=\"this.form.submit\(\)\".*\>[\s\S]*Button Label2[\s\S]*<\/button>/iu',
            $widget->getButtonHtml('Button Label2', 'this.form.submit()')
        );
    }

    public function testGetSuffixId()
    {
        $block = Mage::getObjectManager()->create('Mage_Backend_Block_Widget');
        $this->assertStringEndsNotWith('_test', $block->getSuffixId('suffix'));
        $this->assertStringEndsWith('_test', $block->getSuffixId('test'));
    }
}
