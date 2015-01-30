<?php

// application/models/CasemanagersMapper.php
class Application_Model_CasemanagersMapper {
	
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
			$this->setDbTable('Application_Model_DbTable_Casemanagers');
		}
		return $this->_dbTable;
	}
	
	public function save(Application_Model_Casemanagers $casemanagers) {
		$data = array(
                       /*
			'firstName' => $casemanagers->getFirstName(),
			'lastName' => $casemanagers->getLastName(),
			'middleName' => $casemanagers->getMiddleName(),
			'email' => $casemanagers->getEmail(),
                       */
                        'userID' => $casemanagers->getUserID(),
			'createdBy' => $casemanagers->getCreatedBy(),
			'updatedBy' => $casemanagers->getUpdatedBy(),
			'createdDate' => $casemanagers->getCreatedDate(),
			'updateDate' => date('Y-m-d H:i:s')
		);
		if (null === ($id = $casemanagers->getId())) {
			unset($data['id']);
			$data['createdDate'] = date('Y-m-d H:i:s');
			$data['createdBy'] = $casemanagers->getCreatedBy();
			$this->getDbTable()->insert($data);
			$id = $this->getDbTable()->getAdapter()->lastInsertId();
		}
		else {
			$data['updatedDate'] = date('Y-m-d H:i:s');
			$data['updatedBy'] = $casemanagers->getUpdatedBy();
			$this->getDbTable()->update($data, array('id = ?' => $id));
		}
		return $id;
	}
	
	public function find($id, Application_Model_Casemanagers $casemanagers){
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)){
			return ;
		}
		$row = $result->current();
		$casemanagers->setId($row->id)
				    /*	 ->setFisrtName($row->firstName)
					 ->setMiddleName($row->middleName)
					 ->setLastName($row->lastName)
					 ->setEmail($row->email)
                                    */
                                         ->setUserID($row->userID)
					 ->setCreatedBy($row->createdBy)
					 ->setUpdatedBy($row->updatedBy)
					 ->setCreatedDate($row->createdDate)
					 ->setUpdateDate($row->updateDate);
		return $casemanagers;
	}				
	public function fetchAll(){
		$resultSet = $this->getDbTable()->fetchAll();
		$entries   = array();
		foreach ($resultSet as $row){
			$entry = new Application_Model_Casemanagers();
			$entry->setId($row->id)
				/*  ->setFirstName($row->firstName)
				  ->setMiddleName($row->middleName)
				  ->setLastName($row->lastName)
				  ->setEmail($row->email)
                                */
                                  ->setUserID($row->userID)
				  ->setCreatedBy($row->createdBy)
				  ->setUpdatedBy($row->updatedBy)
				  ->setCreatedDate($row->createdDate)
				  ->setUpdatedDate($row->updateDate);
			$entries[] = $entry;
		}
		return $entries;
	}
        
        
}
?>