<?php
// application/models/ServicesMapper.php
class Application_Model_ServicesMapper {	

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
			$this->setDbTable('Application_Model_DbTable_Services');
		}
		return $this->_dbTable;
	}
	
	public function getAdapter(){
		return Zend_Db_Table::getDefaultAdapter();
	}
	
	public function save(Application_Model_Services $services) {
		$data = array(
			'serviceCode' => $services->getServiceCode(),
			'serviceCategory' => $services->getServiceCategory(),
			'description' => $services->getDescription(),
			'planId' => $services->getPlanId()
		);
		if (null === ($id = $services->getId())) {
			unset($data['id']);
			$data['createdDate'] = date('Y-m-d H:i:s');
			$data['createdBy'] = $services->getCreatedBy();
			$this->getDbTable()->insert($data);
			$id = $this->getDbTable()->getAdapter()->lastInsertId();
		}
		else {
			$data['updatedDate'] = date('Y-m-d H:i:s');
			$data['updatedBy'] = $services->getUpdatedBy();
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
		$service = new Application_Model_Services();
		$service->setId($row->id)
			  ->setServiceCode($row->serviceCode)
			  ->setServiceCategory($row->serviceCategory)
			  ->setDescription($row->description)
			  ->setPlanId($row->planId)
			  ->setCreatedBy($row->createdBy)
			  ->setUpdatedBy($row->updatedBy)
			  ->setCreatedDate($row->createdDate)
			  ->setUpdatedDate($row->updatedDate);
		return $service;
	}				
	public function fetchAll($where = NULL, $order = null, $count = null, $offset = null){
		$resultSet = $this->getDbTable()->fetchAll($where = NULL, $order = null, $count = null, $offset = null);
		$entries   = array();
		foreach ($resultSet as $row){
			$entry = new Application_Model_Services();
			$entry->setId($row->id)
				  ->setServiceCode($row->serviceCode)
				  ->setDescription($row->description)
				  ->setServiceCategory($row->serviceCategory)
				  ->setPlanId($row->planId)
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
			$planId = $row->planId;
			$planName = $this->findPlanName($planId );
			//$planName = $planRow[$planId];
			
			$entry = new Application_Model_Services();
			$entry->setId($row->id)
				  ->setServiceCode($row->serviceCode)
				  ->setDescription($row->description)
				  ->setServiceCategory($row->serviceCategory)
				  ->setPlanId($row->planId)
				  ->setPlanName($planName)
				  ->setCreatedBy($row->createdBy)
				  ->setUpdatedBy($row->updatedBy)
				  ->setCreatedDate($row->createdDate)
				  ->setUpdatedDate($row->updatedDate);
			$entries[] = $entry;
		}	
		return $entries;
	}
	
	public function findPlanName($planId) {
		//Get the default adapter
		$db = $this->getAdapter();
		
		$result = $db->fetchCol(
    						'SELECT planName FROM plans WHERE id = ?', $planId);
		if (count($result) > 0){
 			$planName = $result[0];
 			
		} else {
			$planName = '';
		}
		return $planName;
	}
	public function findPlanId($planName){
		//Get the default adapter
		$db = $this->getAdapter();
		
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
    	$result = $db->fetchPairs('SELECT planName, id FROM plans WHERE planName = ?', $planName);
     	
		return $result;
	}
        public function fetchServicesPerPlan($planId, $order = array("column"=>null,"mode"=>null), $limit=NULL){
                $db = $this->getAdapter();
                $sql = 'SELECT * FROM services WHERE planId=? ';
                if (!is_null($order['column']))
                {
                    $sql .= " ORDER BY " . $order['column'];
                }
                if (!is_null($order['mode']))
                {
                    $sql .= " " .$order['mode'];
                }
                if (!is_null($limit))
                {
                    $sql .= " LIMIT " . $limit;
                }
                $smt = $db->query($sql,$planId);
                
                $services = $smt->fetchAll();
                if (is_array($services)){
                    return $services;
                }
                else{
                    return false;
                }        
        }    
	public function fetchAService($serviceCode){
    	//Get the default adapter
		$db = $this->getAdapter();
    	
		$stmt = $db->query(
			'SELECT s.serviceCode as serviceCode, s.serviceCategory as serviceCategory, s.description as description,
					p.planName as planName  
			 FROM services s JOIN plans p ON s.planId = p.id
			 WHERE serviceCode = ?', $serviceCode);
		
		$service = $stmt->fetchAll();
                if (is_array($service))
                    return $service;
                else
                    return false;
    }
}
?>

     
