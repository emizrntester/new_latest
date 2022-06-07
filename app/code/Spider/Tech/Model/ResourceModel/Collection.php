<?php 
namespace Spider\Data\Model\ResourceModel;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{
	public function _construct(){
		$this->_init("Spider\Tech\Model\DataExample","Spider\Tech\Model\ResourceModel\DataExample");
	}
}
 ?>