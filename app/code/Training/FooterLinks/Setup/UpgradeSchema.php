<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 9/8/2016
 * Time: 3:47 PM
 */

namespace Training\FooterLinks\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.0.2') < 0) {
            // Drop store table
            $table = $setup->getTable('footerlinks_store');
            $connection = $setup->getConnection();
            $connection->dropTable($table);

            $table = $setup->getTable('footerlinks_groups');
            $connection->modifyColumn($table,'store_id',array(
                'type'=>\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length'=>255
            ));
        }

        if (version_compare($context->getVersion(), '0.0.3') < 0) {

            $sortColumnDefinintion = array(
                'type'=>\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                'comment'=>'Sort Order',
                'nullable'=>false,
                'default'=>99
            );
            
            // Add column 'sort_order' to table 'footerlinks_links'
            $table = $setup->getTable('footerlinks_links');
            $setup->getConnection()->addColumn($table,'sort_order',$sortColumnDefinintion);

            // Add column 'sort_order' to table 'footerlinks_groups'
            $table = $setup->getTable('footerlinks_groups');
            $setup->getConnection()->addColumn($table,'sort_order',$sortColumnDefinintion);
        }

        $setup->endSetup();
    }
}