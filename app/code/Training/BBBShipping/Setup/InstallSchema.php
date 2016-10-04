<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 10/4/2016
 * Time: 2:26 PM
 */

namespace Training\BBBShipping\Setup;

use \Magento\Framework\Setup\InstallSchemaInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order_grid'),
            'bbb_code',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'comment' => 'BayBanBua Code'
            ]
        );
    }

}