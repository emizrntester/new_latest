<?php
namespace Bundle\Customoption\Setup;
 
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
 
class UpgradeSchema implements UpgradeSchemaInterface
{
 
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        //die('fsfsdffsdfs');
        /*if (version_compare($context->getVersion(), '1.0.7', '<')) {
            //die('fsfsdffsdfs');
            $connection = $setup->getConnection();
            $connection->addColumn(
                $setup->getTable('catalog_product_bundle_selection'),
                'custom_bundle_option',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'length' => 255,
                    'nullable' => true,
                    'default' => '',
                    'comment' => 'Bundle Text option'
                ]
            );
        }*/
         $installer = $setup;

        $installer->startSetup();
        /*if (version_compare($context->getVersion(), "1.0.0", "<")) {
        //Your upgrade script
        }*/
        if (version_compare($context->getVersion(), '1.0.7', '<')) {
          $installer->getConnection()->addColumn(
                $installer->getTable('catalog_product_bundle_selection'),
                'custom_bundle_option',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 55,
                    'nullable' => true,
                    'comment' => 'Bundle Text optiong'
                ]
            );
        }
        $installer->endSetup();
   
    }
}
?>