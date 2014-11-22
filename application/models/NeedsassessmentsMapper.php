<?php
// application/models/NeedsassessmentsMapper.php
class Application_Model_NeedsassessmentsMapper {	

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
			$this->setDbTable('Application_Model_DbTable_Needsassessments');
		}
		return $this->_dbTable;
	}
	
	public function getAdapter(){
		return Zend_Db_Table::getDefaultAdapter();
	}
	
	public function save(Application_Model_Needsassessments $needsassessments) {
		$data = array(
			'clientId' => $needsassessments->getClientId(),
			'serviceId' => $needsassessments->getServiceId(),
			'comments' => $needsassessments->getComments()
		);
		// Check if the row exist and set the created or updated date and users 
		if (null === ($id = $needsassessments->getId())) {
			unset($data['id']);
			$data['createdDate'] = date('Y-m-d H:i:s');
			$data['createdBy'] = $needsassessments->getCreatedBy();
			$this->getDbTable()->insert($data);
			$id = $this->getDbTable()->getAdapter()->lastInsertId();
		}
		else {
			$data['updatedDate'] = date('Y-m-d H:i:s');
			$data['updatedBy'] = $needsassessments->getUpdatedBy();
			$this->getDbTable()->update($data, array('id = ?' => $id));
		}
		return $id;
	}
	
	public function find($id, Application_Model_Needsassessments $needsassessments){
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)){
			return ;
		}
		$row = $result->current();
		$needsassessments->setId($row->id)
			  			 ->setClientId($row->clientId)
			  			 ->setServiceId($row->serviceId)
			  			 ->setComments($row->comments)
			  			 ->setCreatedBy($row->createdBy)
			  			 ->setUpdatedBy($row->updatedBy)
			  			 ->setCreatedDate($row->createdDate)
			  			 ->setUpdateDate($row->updateDate);
		return $needsassessments;
	}				
	public function fetchAll(){
		$resultSet = $this->getDbTable()->fetchAll();
		$entries   = array();
		foreach ($resultSet as $row){
			$entry = new Application_Model_Needsassessments();
			$entry->setId($row->id)
				  ->setClientId($row->clientId)
			  	  ->setServiceId($row->serviceId)
			  	  ->setComments($row->comments)
			  	  ->setCreatedBy($row->createdBy)
				  ->setUpdatedBy($row->updatedBy)
				  ->setCreatedDate($row->createdDate)
				  ->setUpdateDate($row->updateDate);
			$entries[] = $entry;
		}
		return $entries;
	}
	public function fetchFullRows(){
		$resultSet = $this->getDbTable()->fetchAll();
		$entries   = array();
		foreach ($resultSet as $row){
			$clientId = $row->clientId;
			$clientName = $this->findClientName($clientId);
			$serviceId = $row->serviceId;
			$serviceCode = $this->findServiceCode($serviceId);
			
			$entry = new Application_Model_Needsassessments();
			$entry->setId($row->id)
				  ->setClientId($row->clientId)
			  	  ->setServiceId($row->serviceId)
			  	  ->setClientName($clientName)
			  	  ->setServiceCode($serviceCode)
			  	  ->setComments($row->comments)
			  	  ->setCreatedBy($row->createdBy)
				  ->setUpdatedBy($row->updatedBy)
				  ->setCreatedDate($row->createdDate)
				  ->setUpdatedDate($row->updateDate);
			$entries[] = $entry;
		}
		return $entries; 
	}
	// Find the row in the clients table with the specific clientId
	public function findClient($clientId){
		
		$needsRow = $this->getDbTable()->find($clientId)->current();
		//$clientMapper = new Application_Model_ClientsMapper();
		
		// Get the parent row in the clients table
		$clientsRow = $needsRow->findParentRow('Application_Model_DbTable_Clients');
		
		return $clientsRow;
	}
	// Find the client's id from is alien number
	public function findClientId($alienNumber){
		//Get the default adapter
		$db = $this->getAdapter();
		
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
    	$result = $db->fetchPairs('SELECT alienNumber, id FROM clients WHERE alienNumber = ?', $alienNumber);
     	
		return $result;
	}
	
	// Find the row in the services table with the specific servicesId
	public function findService($serviceId){
		
		$needsRow = $this->getDbTable()->find($serviceId)->current();
		
		$servicesRow = $needs->findParentRow('Application_Model_DbTable_Service');
		
		return $servicesRow;
	}
	// Find the service's id in services from the serviceCode 
	public function findServiceId($serviceCode){
		//Get the default adapter
		$db = $this->getAdapter();
		
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
    	$result = $db->fetchPairs('SELECT serviceCode, id FROM  services WHERE serviceCode = ?', $serviceCode);
     	
		return $result;
	}
	
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
	// Find the service's code and client ssn for a needsassessment
	public function findForeignValues($id){
		//$db = $this->getAdapter();

		//$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//	$result = $db->fetchAssoc(		
	//	'SELECT n.id as id, n.clientId as clientId, n.serviceId as serviceId FROM needsassessements n
    	//		WHERE 	n.ssn = 
    		//			id = ?
    			//		JOIN clients c on n.clientid = c.id 
    				//	JOIN services s on n.serviceid = s.id',$id);
		
//		return $result;	
	}
	
}
?>
