<?php
// application/models/ClientsMapper.php
class Application_Model_ClientsMapper {	

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
			$this->setDbTable('Application_Model_DbTable_Clients');
		}
		return $this->_dbTable;
	}
	
	public function getAdapter(){
		return Zend_Db_Table::getDefaultAdapter();
	}
	
	public function save(Application_Model_Clients $clients) {
		$data = array(
			'firstName' => $clients->getFirstName(),
			'lastName' => $clients->getLastName(),
			'middleName' => $clients->getMiddleName(),
			'dateOfBirth' => $clients->getDateOfBirth(),
			'street' => $clients->getStreet(),
			'city' => $clients->getCity(),
			'gender' => $clients->getGender(),
			'languageSpoken' => $clients->getLanguageSpoken(),
			'countryOfOrigin' => $clients->getCountryOfOrigin(),
			'email' => $clients->getEmail(),
			'homePhone' => $clients->getHomePhone(),
			'homeType' => $clients->getHomeType(),
			'cellPhone' => $clients->getCellPhone(),
			'workPhone' => $clients->getWorkPhone(),
			'dateOfIntake' => $clients->getDateOfIntake(),
			'alienNumber' => $clients->getAlienNumber(),
			'ssn' => $clients->getSsn(),
			'immigrationStatus' => $clients->getImmigrationStatus(),
			'emergencyContactName' => $clients->getEmergencyContactName(),
			'contactPhone' => $clients->getContactPhone(),
			'contactRelationship' => $clients->getContactRelationship(),
			'contactPhoneType' => $clients->getContactPhoneType(),
			'isDependent' => $clients->getIsDependent(),
			'houseHoldSize' => $clients->getHouseHoldSize(),
			'dateOfArrival' => $clients->getDateOfArrival(),
			'maritalStatus' => $clients->getMaritalStatus()
		);
		if (null === ($id = $clients->getId())) {
			unset($data['id']);
			$data['createdDate'] = date('Y-m-d H:i:s');
			$data['createdBy'] = $clients->getCreatedBy();
			$this->getDbTable()->insert($data);
			$id = $this->getDbTable()->getAdapter()->lastInsertId();
		}
		else {
			$data['updatedDate'] = date('Y-m-d H:i:s');
			$data['updatedBy'] = $clients->getUpdatedBy();
			$this->getDbTable()->update($data, array('id = ?' => $id));
		}
		return $id;
	}
	
	public function find($id){
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)){
			return ;
		}
		$row = $result->current();
		
		$client = new Application_Model_Clients(); 
		
		$client->setId($row->id)
			    ->setFirstName($row->firstName)
			    ->setLastName($row->lastName)
				->setMiddleName($row->middleName)
				->setDateOfBirth($row->dateOfBirth)
				->setStreet($row->street)
				->setCity($row->city)
				->setHomeType($row->homeType)
				->setGender($row->gender)
				->setLanguageSpoken($row->languageSpoken)
				->setCountryOfOrigin($row->countryOfOrigin)
				->setEmail($row->email)
				->setHomePhone($row->homePhone)
				->setCellPhone($row->cellPhone)
				->setWorkPhone($row->workPhone)
				->setDateOfIntake($row->dateOfIntake)
				->setAlienNumber($row->alienNumber)
				->setSsn($row->ssn)
				->setImmigrationStatus($row->immigrationStatus)
				->setEmergencyContactName($row->emergencyContactName)
				->setContactPhone($row->contactPhone)
				->setContactRelationship($row->contactRelationship)
				->setContactPhoneType($row->contactPhoneType)
				->setMaritalStatus($row->maritalStatus)
				->setIsDependant($row->isDependent)
				->setHouseHoldSize($row->houseHoldSize)
				->setDateOfArrival($row->dateOfArrival)
				->setCreatedBy($row->createdBy)
				->setUpdatedBy($row->updatedBy)
				->setCreatedDate($row->createdDate)
				->setUpdatedDate($row->updatedDate)
				->setParentId($row->parentId);
		return $client;
	}				
	public function fetchAll(){
		$resultSet = $this->getDbTable()->fetchAll();
		$entries   = array();
		foreach ($resultSet as $row){
			
			$entry = new Application_Model_Clients();
			$entry->setId($row->id)
				  ->setFirstName($row->firstName)
				  ->setLastName($row->lastName)
				  ->setFirstName($row->middleName)
				  ->setDateOfBirth($row->dateOfBirth)
				  ->setStreet($row->street)
				  ->setCity($row->city)
				  ->setGender($row->gender)
				  ->setLanguageSpoken($row->languageSpoken)
				  ->setCountryOfOrigin($row->countryOfOrigin)
				  ->setEmail($row->email)
				  ->setHomePhone($row->homePhone)
				  ->setHomeType($row->homeType)
				  ->setCellPhone($row->cellPhone)
				  ->setWorkPhone($row->workPhone)
				  ->setDateOfIntake($row->dateOfIntake)
				  ->setAlienNumber($row->alienNumber)
				  ->setSsn($row->ssn)
				  ->setImmigrationStatus($row->immigrationStatus)
				  ->setEmergencyContactName($row->emergencyContactName)
				  ->setContactPhone($row->contactPhone)
				  ->setContactRelationship($row->contactRelationship)
			//	  ->setContactPhoneType($row->contactPhoneType)
		          ->setMaritalStatus($row->maritalStatus)
		    	  ->setIsDependent($row->isDependent)
				  ->setHouseHoldSize($row->houseHoldSize)
				  ->setDateOfArrival($row->dateOfArrival)
				  ->setCreatedBy($row->createdBy)
				  ->setUpdatedBy($row->updatedBy)
				  ->setCreatedDate($row->createdDate)
				  ->setUpdatedDate($row->updatedDate)
				  ->setParentId($row->parentId);
			$entries[] = $entry;
		}
		return $entries;
	}
	public function findParentIdRow($parentId){
		$clients = $this->getDbTable()->find($parentId)->current();
		
		return $clientsParent;
	}
	public function fetchNeedsassessments($alienNumber){
		//Get the default adapter
		$db = $this->getAdapter();
		
		$stmt = $db->query(
			'SELECT s.serviceCode AS serviceCode, n.comments AS comments 
			 FROM needsassessments n JOIN services s ON n.serviceId = s.id 
									JOIN clients c ON n.clientId = c.id 
									WHERE c.alienNumber = ?', $alienNumber);	
		$needsSet = $stmt->fetchAll();
		return $needsSet;
    }
    public function fetchFollowup($alienNumber){
    	//Get the default adapter
		$db = $this->getAdapter();
    	
		$stmt = $db->query(
			'SELECT f.Id AS id, f.clientId AS clientId, f.actionTaken AS actionTaken, f.dateOfAction AS dateOfAction, f.comments AS comments, concat(c.firstName, " ",c.lastName) AS clientName,
					f.planId AS planId, p.planName AS planName, f.caseManagerId AS casemanagerId, CONCAT(ca.firstName, " ", ca.lastName) AS casemanagerName,
					ca.email AS email, f.serviceId AS serviceId, s.serviceCode AS serviceCode
			FROM followup f JOIN clients c ON clientId = c.id JOIN plans p ON planId = p.id JOIN services s ON serviceId = s.id  JOIN casemanagers ca ON casemanagerId = ca.id
			where c.alienNumber = ?', $alienNumber);
		
		$followupSet = $stmt->fetchAll();
		return $followupSet;
    }
 	public function fetchAClient($alienNumber){
    	//Get the default adapter
		$db = $this->getAdapter();
    	
		$stmt = $db->query(
			'SELECT firstName, lastName, middleName, dateOfBirth, street, city, email, alienNumber, 
					gender, maritalStatus, houseHoldSize, dateOfIntake, immigrationStatus, countryOfOrigin, languageSpoken, dateOfArrival, homePhone,
					cellPhone, workPhone, homeType, emergencyContactName, contactRelationship, contactPhone, contactPhoneType  
			FROM clients
			WHERE alienNumber = ?', $alienNumber);
		
		$client = $stmt->fetchAll();
		return $client;
    }
}
?>
