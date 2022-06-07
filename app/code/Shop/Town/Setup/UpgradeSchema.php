<?php 
namespace Shop\Town\Setup;   
use Magento\Framework\Setup\UpgradeSchemaInterface; 
use Magento\Framework\Setup\ModuleContextInterface; 
use Magento\Framework\Setup\SchemaSetupInterface; 
use Magento\Framework\DB\Ddl\Table; 

class UpgradeSchema implements UpgradeSchemaInterface { 
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context) { 
         if (version_compare($context–>getVersion(), ‘1.0.1’) < 0) { 
            $connection = $setup–>getConnection();
            $connection–>addColumn(
                $setup–>getTable(‘Customerdetails’),
                ‘Upload_img’,
                [
                    ‘type’ => Table::TYPE_TEXT,
                    ‘length’ => 255,
                    ‘nullable’ => true,
                    ‘default’ => ”,
                    ‘comment’ => ‘Add New Filed’
                ]
            );
        }
    }
}