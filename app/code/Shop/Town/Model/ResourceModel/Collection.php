<?php 
namespace Shop\Town\Model\ResourceModel;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{
	public function _construct(){
		$this->_init("Shop\Town\Model\DataExample","Shop\Town\Model\ResourceModel\DataExample");
	}
}
 ?>