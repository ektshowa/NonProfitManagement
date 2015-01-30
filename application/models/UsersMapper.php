<?php
// application/models/UsersMapper.php
class Application_Model_UsersMapper {

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
			$this->setDbTable('Application_Model_DbTable_Users');
		}
		return $this->_dbTable;
	}
	
	public function save(Application_Model_Users $users) {
                $firstname = $users->getFirstName();
                $lastname = $users->getLastName();
                $username = strtoupper(substr($firstname, 0, 1)) . ucfirst($lastname);
                
            
		$data = array(
			'firstName' => $firstname,
			'lastName' => $lastname,
			'middleName' => $users->getMiddleName(),
			'username' => $username,
			'email' => $users->getEmail(),
                        'roleId' => $users->getRoleId()
		);
		if (null === ($id = $users->getId())) {
			unset($data['id']);
			
                        if (is_null($users->getPassword()))
                            return false;
                        
			$data['password'] = md5($users->getPassword());
			$data['createdDate'] = date('Y-m-d H:i:s');
			$data['createdBy'] = $users->getCreatedBy();
			$this->getDbTable()->insert($data);
			$id = $this->getDbTable()->getAdapter()->lastInsertId();
		}
		else {
			$data['updatedDate'] = date('Y-m-d H:i:s');
			$data['updatedBy'] = $users->getUpdatedBy();
			$this->getDbTable()->update($data, array('id = ?' => $id));
		}
		//Return the id of the last inserted record
		return $id;
	}
	
	public function find($id, Application_Model_Users $users){
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)){
			return FALSE;
		}
		$row = $result->current();
		$users->setId($row->id)
		      ->setFirstName($row->firstName)
		      ->setLastName($row->lastName)
		      ->setMiddleName($row->middleName)
                      ->setUsername($row->username)
		      ->setPassword($row->password)
		      ->setEmail($row->email)
                      ->setRole($row->role)
		      ->setCreatedBy($row->createdBy)
		      ->setUpdatedBy($row->updatedBy)
		      ->setCreatedDate($row->createdDate)
		      ->setUpdatedDate($row->updatedDate);
		return $users;
	}				
	public function fetchAll(){
		$resultSet = $this->getDbTable()->fetchAll();
		$entries   = array();
		foreach ($resultSet as $row){
			$entry = new Application_Model_Users();
			$entry->setId($row->id)
				  ->setFirstName($row->firstName)
				  ->setLastName($row->lastName)
				  ->setMiddleName($row->middleName)
				  ->setUsername($row->username)
			  	  ->setPassword($row->password)
                                  ->setEmail($row->email)
                                  ->setRole($row->role)
				  ->setCreatedBy($row->createdBy)
				  ->setUpdatedBy($row->updatedBy)
				  ->setCreatedDate($row->createdDate)
				  ->setUpdatedDate($row->updatedDate);
			$entries[] = $entry;
		}
		return $entries;
	}
	public function updatePassword($id, $password){
		
		//fetch the user's row
		$rowUser = $this->getDbTable()->find($id)->current();
		
		if ($rowUser) {
			//update the password
			$rowUser->password = md5($password);
			$rowUser->save(); 
		}
		else {
			throw new Zend_Exception("Password update failed. User not found!");
		}
	}
	public function deleteUser($id){
		// fetch the user's row
		$rowUser = $this->getDbTable()->find($id)->current();
		if ($rowUser){
			$rowUser->delete();
		}
		else {
			throw new  Zend_Exception("Could not delete the user. User not found");
		}
	}
}
?>
