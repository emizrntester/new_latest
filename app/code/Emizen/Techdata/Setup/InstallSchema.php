<?php 
namespace Emizen\Techdata\Setup;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface{
    public function install(SchemaSetupInterface $setup,ModuleContextInterface $context){
        $setup->startSetup();   
        $conn = $setup->getConnection();
        $tableName = $setup->getTable('techdata');
        if($conn->isTableExists($tableName) != true){
            $table = $conn->newTable($tableName)
                            ->addColumn(
                                'id',
                                Table::TYPE_INTEGER,
                                null,
                     ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true]
                                )
                            ->addColumn(
                                'name',
                                Table::TYPE_TEXT,
                                255,
                                ['nullable'=>false,'default'=>''],
                                'Name'
                                )
                            ->addColumn(
                                'email',
                                Table::TYPE_TEXT,
                                '2M',
                                ['nullbale'=>false,'default'=>''],
                                'Email'
                                )
                            ->addColumn(
                                'telephone',
                                Table::TYPE_TEXT,
                                '2M',
                                ['nullbale'=>false,'default'=>''],
                                'Telephone'
                                )
                            ->setOption('charset','utf8');
            $conn->createTable($table);
        }
        $setup->endSetup();
    }
}
?>