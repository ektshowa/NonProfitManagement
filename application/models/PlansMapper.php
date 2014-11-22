<?php
// application/models/PlansMapper.php
class Application_Model_PlansMapper {	

	protected $_dbTable;
	
	public function setDbTable($dbTable){
		if (is_string($dbTable)){
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Zend_Db_Table_Abstract){
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_dbTable = $dbTable;
		return $this;
	}
	
	public function getDbTable(){
		if (null === $this->_dbTable){
			$this->setDbTable('Application_Model_DbTable_Plans');
		}
		return $this->_dbTable;
	}
	
	public function getAdapter(){
		return Zend_Db_Table::getDefaultAdapter();
	}
	
	public function save(Application_Model_Plans $plans) {
		$data = array(
			'planName' => $plans->getPlanName(),
			'description' => $plans->getDescription()
		);
		if (null === ($id = $plans->getId())) {
			unset($data['id']);
			$data['createdDate'] = date('Y-m-d H:i:s');
			$data['createdBy'] = $plans->getCreatedBy();
			$this->getDbTable()->insert($data);
			$id = $this->getDbTable()->getAdapter()->lastInsertId();
		}
		else {
			$data['updatedDate'] = date('Y-m-d H:i:s');
			$data['updatedBy'] = $plans->getUpdatedBy();
			$this->getDbTable()->update($data, array('id = ?' => $id));
		}
		return $id;
	}
	
	public function find($id, Application_Model_Plans $plans){
		$result = $this->getDbTable()->find($id);
		if (!(count($result)) > 0){
			return FALSE;
		}
		$row = $result->current();
		$plans->setId($row->id)
			  ->setPlanName($row->planName)
			  ->setDescription($row->description)
			  ->setCreatedBy($row->createdBy)
			  ->setUpdatedBy($row->updatedBy)
			  ->setCreatedDate($row->createdDate)
			  ->setUpdatedDate($row->updatedDate);
		return $plans;
	}				
	public function fetchAll(){
		$resultSet = $this->getDbTable()->fetchAll();
		$entries   = array();
		foreach ($resultSet as $row){
			$entry = new Application_Model_Plans();
			$entry->setId($row->id)
				  ->setPlanName($row->planName)
				  ->setDescription($row->description)
				  ->setCreatedBy($row->createdBy)
				  ->setUpdatedBy($row->updatedBy)
				  ->setCreatedDate($row->createdDate)
				  ->setUpdatedDate($row->updatedDate);
			$entries[] = $entry;
		}
		return $entries;
	}
	public function fetchAPlan($planName){
    	//Get the default adapter
		$db = $this->getAdapter();
    	
		$stmt = $db->query(
			'SELECT planName, description  
			 FROM plans
			 WHERE planName = ?', $planName);
		
		$plan = $stmt->fetchAll();
		return $plan;
    }
    public function fetchServices($planName){
    	$db = $this->getAdapter();
    	
    	$stmt = $db->query(
    		'SELECT s.serviceCode, s.serviceCategory, s.description 
			 FROM services s JOIN plans p ON p.Id = s.planId 
			 WHERE planName = ?', $planName);
    	
    	$services = $stmt->fetchAll();
		return $services;
    }
}
?>
