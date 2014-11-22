<?php
// application/models/FollowupMapper.php
class Application_Model_FollowupMapper {	
	
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
			$this->setDbTable('Application_Model_DbTable_Followup');
		}
		return $this->_dbTable;
	}
	
	public function getAdapter(){
		return Zend_Db_Table::getDefaultAdapter();
	}
	
	public function save(Application_Model_Followups $followup) {
		$data = array(
			'clientId' => $followup->getClientId(),
			'actionTaken' => $followup->getActionTaken(),
			'planId' => $followup->getPlanId(),
			'comments' => $followup->getComments(),
			'dateOfAction' => $followup->getDateOfAction(),
			'caseManagerId' => $followup->getCaseManagerId(),
			'serviceId' => $followup->getServiceId()
		);
		if (null === ($id = $followup->getId())) {
			unset($data['id']);
			$data['createdDate'] = date('Y-m-d H:i:s');
			$data['createdBy'] = $followup->getCreatedBy();
			$this->getDbTable()->insert($data);
			$id = $this->getDbTable()->getAdapter()->lastInsertId();
		}
		else {
			$data['updatedDate'] = date('Y-m-d H:i:s');
			$data['updatedBy'] = $followup->getUpdatedBy();
			$this->getDbTable()->update($data, array('id = ?' => $id));
		}
		return $id;
	}
	
	public function find($id){
		$followup = new Application_Model_Followups();
		
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)){
			return ;
		}
		$row = $result->current();
		$followup->setId($row->id)
			  ->setClientId($row->clientId)
			  ->setActionTaken($row->actionTaken)
			  ->setPlanId($row->planId)
			  ->setComments($row->comments)
			  ->setDateOfAction($row->dateOfAction)
			  ->setCaseManagerId($row->caseManagerId)
			  ->setCreatedBy($row->createdBy)
			  ->setUpdatedBy($row->updatedBy)
			  ->setCreatedDate($row->createdDate)
			  ->setUpdatedDate($row->updatedDate);
		return $followup;
	}				
	public function fetchAll(){
		$resultSet = $this->getDbTable()->fetchAll();
		$entries   = array();
		foreach ($resultSet as $row){
			$entry = new Application_Model_Followups();
			$entry->setId($row->id)
				  ->setClientId($row->clientId)
			  	  ->setActionTaken($row->actionTaken)
			  	  ->setPlanId($row->planId)
			  	  ->setComments($row->comments)
			  	  ->setDateOfAction($row->dateOfAction)
			  	  ->setCaseManagerId($row->caseManagerId)
			  	  ->setCreatedBy($row->createdBy)
				  ->setUpdatedBy($row->updatedBy)
				  ->setCreatedDate($row->createdDate)
				  ->setUpdatedDate($row->updatedDate);
			$entries[] = $entry;
		}
		return $entries;
	}
	
	public function fetchFullRows(){
		$resultSet = $this->getDbTable()->fetchAll();
		$entries   = array();
		foreach ($resultSet as $row){
			$clientName = $this->findClientName($row->clientId);
			$serviceCode = $this->findServiceCode($row->serviceId);
			$planName = $this->findPlanName($row->planId);
			
			$caseManagerRow = $this->findCaseManager($row->caseManagerId);
			$caseManagerName = $caseManagerRow['caseManagerName'];
			
			$entry = new Application_Model_Followups();
			$entry->setId($row->id)
				  ->setClientId($row->clientId)
			  	  ->setServiceId($row->serviceId)
			  	  ->setClientName($clientName)
			  	  ->setServiceCode($serviceCode)
			  	  ->setCaseManagerName($caseManagerName)
			  	  ->setPlanName($planName)
			  	  ->setDateOfAction($row->dateOfAction)
			  	  ->setActionTaken($row->actionTaken)
			  	  ->setComments($row->comments)
			  	  ->setCreatedBy($row->createdBy)
				  ->setUpdatedBy($row->updatedBy)
				  ->setCreatedDate($row->createdDate)
				  ->setUpdatedDate($row->updateDate);
			$entries[] = $entry;
		}
		return $entries; 
	}
	
	// Find the service's id in services from the serviceCode 
	public function findServiceId($serviceCode){
		//Get the default adapter
		$db = $this->getAdapter();
		
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
    	$result = $db->fetchPairs('SELECT serviceCode, id FROM  services WHERE serviceCode = ?', $serviceCode);
     	
		return $result;
	}
	// Find the service's code in services from the serviceId
	public function findServiceCode($serviceId) {
		//Get the default adapter
		$db = $this->getAdapter();
		
		$result = $db->fetchCol(
    						'SELECT serviceCode FROM services WHERE id = ?', $serviceId);
		if (count($result) > 0){
 			$serviceCode = $result[0];
 			
		} else {
			$serviceCode = '';
		}
		return $serviceCode;
	}
	// Find the clientName from the clientId
	public function findClientName($clientId){
		//Get the default adapter
		$db = $this->getAdapter();
		
		$result = $db->fetchCol(
    						"SELECT CONCAT(firstName, ' ', lastName) as clientName 
    						 		FROM clients WHERE id = ?", $clientId);
		if (count($result) > 0){
 			$clientName = $result[0];
 			
		} else {
			$clientName = '';
		}
		return $clientName;
	}
	
	// Find the client's id from is alien number
	public function findClientId($alienNumber){
		//Get the default adapter
		$db = $this->getAdapter();
		
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
    	$result = $db->fetchPairs('SELECT alienNumber, id FROM clients WHERE alienNumber = ?', $alienNumber);
     	
		return $result;
	}
	// Find the planName from the planId
	public function findPlanName($planId){
		//Get the default adapter
		$db = $this->getAdapter();
		
		$result = $db->fetchCol(
    						"SELECT planName FROM plans WHERE id = ?", $planId);
		if (count($result) > 0){
 			$planName = $result[0];
 			
		} else {
			$planName = '';
		}
		return $planName;
	}
	
	// Find the caseManagerId from the casemanager's email
		public function findCaseManagerId($email){
		//Get the default adapter
		$db = $this->getAdapter();
		
		$result = $db->fetchCol(
    						"SELECT id FROM casemanagers WHERE email = ?", $email);
		if (count($result) > 0){
 			$caseManagerId = $result[0];
 			
		} else {
			$caseManagerId = null;
		}
		return $caseManagerId;
	}
	
	// Find the caseManager email and name from the caseManagerId
	public function findCaseManager($caseManagerId){
		//Get the default adapter
		$db = $this->getAdapter();
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		$sql = $db->quoteInto("SELECT id, CONCAT(firstName, ' ', lastName) as caseManagerName, email 
										FROM casemanagers WHERE id = ?", $caseManagerId);
		$result = $db->fetchRow($sql);
 
		if (!count($result) > 0){
 			$result = null;	
		} 
		return $result;
	}
	
	// Find the plan's id in plans from the planName 
	public function findPlanId($planName){
		//Get the default adapter
		$db = $this->getAdapter();
		
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
    	$result = $db->fetchPairs('SELECT planName, id FROM  plans WHERE planName = ?', $planName);
     	
		return $result;
	}
}
?>
