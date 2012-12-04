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
 * @category    Tools
 * @package     unit_tests
 * @copyright   Copyright (c) 2012 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

require_once realpath(dirname(__FILE__) . '/../../../../../../../') . '/tools/migration/Acl/Db/FileReader.php';

class Tools_Migration_Acl_Db_FileReaderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Tools_Migration_Acl_Db_FileReader
     */
    protected $_model;

    public function setUp()
    {
        $this->_model = new Tools_Migration_Acl_Db_FileReader();
    }

    public function testExtractData()
    {
        $filePath = __DIR__ . DIRECTORY_SEPARATOR . '../_files' . DIRECTORY_SEPARATOR . 'log'
            . DIRECTORY_SEPARATOR . 'AclXPathToAclId.log';
        $expectedMap = array(
            "admin/test1/test2"        => "Test1_Test2::all",
            "admin/test1/test2/test3"  => "Test1_Test2::test3",
            "admin/test1/test2/test4"  => "Test1_Test2::test4",
            "admin/test1/test2/test5"  => "Test1_Test2::test5",
            "admin/test6"              => "Test6_Test6::all"
        );
        $this->assertEquals($expectedMap, $this->_model->extractData($filePath));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testExtractDataThrowsExceptionIfInvalidFileProvided()
    {
        $this->_model->extractData('invalidFile.log');
    }
}

