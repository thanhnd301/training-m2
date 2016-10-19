<?php
namespace Training\SimpleAffiliate\Setup;

use \Magento\Framework\Setup\InstallSchemaInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
/**
 * Created by PhpStorm.
 * User: thanhnd1
 * Date: 19/10/2016
 * Time: 17:02
 */
class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        /*
         * Create table 'training_affiliate'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('affiliate_banner')
        )->addColumn(
            'banner_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true,'unsigned'=>true],
            'Banner ID'
        )->addColumn(
            'title',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'BAnner Title'
        )->addColumn(
            'image',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Image'
        )->addColumn(
            'url',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Target Url'
        )->addColumn(
            'creation_time',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT,],
            'Creation Time'
        )->addColumn(
            'update_time',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE,],
            'Modification Time'
        )->addColumn(
            'status',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'default' => '1',],
            'Status'
        );
        $installer->getConnection()->createTable($table);

        /*
         * Create table 'affiliate_account'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('affiliate_account')
        )->addColumn(
            'account_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true,'unsigned'=>true],
            'Account ID'
        )->addColumn(
            'customer_id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'default' => '1','unsigned'=>true],
            'Customer ID'
        )->addColumn(
            'firtname',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'First Name'
        )->addColumn(
            'lastname',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Last Name'
        )->addColumn(
            'email',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Email'
        )->addColumn(
            'balance',
            Table::TYPE_DECIMAL,
            [12,4],
            ['nullable'=>false,'default'=>0.0000],
            'Banlance'
        )->addColumn(
            'total_received',
            Table::TYPE_DECIMAL,
            [12,4],
            ['nulable'=>false,'default'=>0.0000],
            'Total Received'
        )->addColumn(
            'creation_time',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT,],
            'Creation Time'
        )->addColumn(
            'update_time',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE,],
            'Modification Time'
        )->addColumn(
            'status',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'default' => '1',],
            'Status'
        )->addForeignKey(
            $installer->getFkName('affiliate_account','customer_id','customer_entity','entity_id'),
            'customer_id',
            $installer->getTable('customer_entity'),
            'entity_id'
        );
        $installer->getConnection()->createTable($table);

        /*
         * Create table 'affiliate_transaction'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('affiliate_transaction')
        )->addColumn(
            'transaction_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true,'unsigned'=>true],
            'Transaction ID'
        )->addColumn(
            'order_id',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Order Auto Increment ID'
        )->addColumn(
            'affiliate_id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false,'unsigned'=>true],
            'Affiliate Account ID'
        )->addColumn(
            'order_total',
            Table::TYPE_DECIMAL,
            [12,4],
            ['nullable' => false,'default'=>0.0000],
            'Total value of order'
        )->addColumn(
            'commission',
            Table::TYPE_DECIMAL,
            [12,4],
            ['nullable' => false, 'default' => 0.0000],
            'Total money of affiliate received'
        )->addColumn(
            'store_id',
            Table::TYPE_SMALLINT,
            null,
            ['nullable'=>false],
            'Store ID'
        )->addColumn(
            'creation_time',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT,],
            'Creation Time'
        )->addColumn(
            'update_time',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE,],
            'Modification Time'
        )->addColumn(
            'status',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'default' => 0],
            'Complete/Pending'
        )->addForeignKey(
            $installer->getFkName('affiliate_transaction','order_id','sales_order','increment_id'),
            'order_id',
            $installer->getTable('sales_order'),
            'increment_id'
        )->addForeignKey(
            $installer->getFkName('affiliate_transaction','affiliate_id','affilate_account','account_id'),
            'affiliate_id',
            $installer->getTable('affiliate_account'),
            'account_id'
        );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }

}