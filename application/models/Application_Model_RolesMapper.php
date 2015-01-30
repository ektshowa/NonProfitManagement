<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Application_Model_RolesMapper {
    
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
			$this->setDbTable('Application_Model_DbTable_Roles');
		}
		return $this->_dbTable;
	}
        
        public function save(Application_Model_Roles $roles, Application_Model_Users $user) {
            
                //$userId = $user->getId();
                if ( $user->getRole() == 'sysadmin'){
                    $data = array(
                        'name' => $roles->getName(),
                        'description' => $roles->getDescription(),
			
                    );
                    if (null === ($id = $roles->getId())) {
			unset($data['id']);
			$data['createdDate'] = date('Y-m-d H:i:s');
			$data['createdBy'] = $roles->getCreatedBy();
                        $data['updatedDate'] = date('Y-m-d H:i:s');
			$data['updatedBy'] = $roles->getUpdatedBy();
                        $this->getDbTable()->insert($data);
			$id = $this->getDbTable()->getAdapter()->lastInsertId();
                    }
                    else {
			$data['updatedDate'] = date('Y-m-d H:i:s');
			$data['updatedBy'] = $roles->getUpdatedBy();
			$this->getDbTable()->update($data, array('id = ?' => $id));
                    }
                    return $id;
                }
                else{
                    return FALSE;
                }
	}
	
}