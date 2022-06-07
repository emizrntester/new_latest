<?php

namespace Bundle\Customoption\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.5') < 0){

		$installer->run('create table bundle_custom_option(id int not null auto_increment,order_id int not null ,item_id int not null, email varchar(100),custom_bundle_option int not null,created_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,product_id int not null,primary key(id))');

		}

        $installer->endSetup();

    }
}