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
 * @package     Mage_Widget
 * @subpackage  integration_tests
 * @copyright   Copyright (c) 2012 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * @group integrity
 */
class Integrity_Mage_Widget_SkinFilesTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider widgetPlaceholderImagesDataProvider
     */
    public function testWidgetPlaceholderImages($skinImage)
    {
        $this->assertFileExists(Mage::getDesign()->getViewFile($skinImage, array('area' => 'adminhtml')));
    }

    /**
     * @return array
     */
    public function widgetPlaceholderImagesDataProvider()
    {
        $result = array();
        /** @var $model Mage_Widget_Model_Widget */
        $model = Mage::getModel('Mage_Widget_Model_Widget');
        foreach ($model->getWidgetsArray() as $row) {
            /** @var $instance Mage_Widget_Model_Widget_Instance */
            $instance = Mage::getModel('Mage_Widget_Model_Widget_Instance');
            $config = $instance->setType($row['type'])->getWidgetConfig();
            // @codingStandardsIgnoreStart
            if (isset($config->placeholder_image)) {
                $result[] = array((string)$config->placeholder_image);
            }
            // @codingStandardsIgnoreEnd
        }
        return $result;
    }
}
