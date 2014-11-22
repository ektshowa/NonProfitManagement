<?php

class Application_Model_Needsassessments {
	protected $_clientId;
	protected $_clientAlienNumber;
	protected $_clientName;
	protected $_serviceCode;
	protected $_serviceId;
	protected $_comments;
	protected $_createdDate;
	protected $_updatedDate;
	protected $_createdBy;
	protected $_updatedBy;
	protected $_id;
	
	public function __construct(array $options = null){
		if (is_array($options)) {
			$this->setOptions($options);
		}
	}
	
	public function __set($name, $value){
		$method = 'set' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid need property');
		}
		$this->$method($value);
	}
	
	public function __get($name){
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid need property');
		}
		return $this->$method();
	}
	
	public function setOptions(array $options){
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (in_array($method, $methods)) {
				$this->$method($value);
			}
		}
		return $this;
	}
	
	public function setClientId($clientId){
		$this->_clientId = (integer) $clientId;
		return $this;
	}
	public function getClientId(){
		return $this->_clientId;
	}
	public function setClientAlienNumber($clientAlienNumber){
		$this->_clientAlienNumber = (string) $clientAlienNumber;
		return $this;
	}
	public function getClientAlienNumber(){
		return $this->_clientAlienNumber;
	}
	public function setClientName($clientName){
		$this->_clientName = (string) $clientName;
		return $this;
	}
	public function getClientName(){
		return $this->_clientName;
	}
	public function setServiceId($serviceId){
		$this->_serviceId = (integer) $serviceId;
		return $this;
	}
	public function getServiceId(){
		return $this->_serviceId;
	}
	public function setServiceCode($serviceCode){
		$this->_serviceCode = (string) $serviceCode;
		return $this;
	}
	public function getServiceCode(){
		return $this->_serviceCode;
	}
	public function setComments($comments){
		$this->_comments = (string) $comments;
		return $this;
	}
	public function getComments(){
		return $this->_comments;
	}
	public function getCreatedBy(){
		return $this->_createdBy;
	}
	public function setCreatedBy($createdBy){
		$this->_createdBy = (string) $createdBy;
		return $this;
	}
	public function getCreatedDate(){
		return $this->_createdDate;
	}
	public function setCreatedDate($createdDate){
		$this->_createdDate = $createdDate;
		return $this;
	}
	public function getUpdatedBy(){
		return $this->_updatedBy;
	}
	public function setUpdatedBy($updatedBy){
		$this->_updatedBy = (string) $updatedBy;
		return $this;
	}
	public function getUpdatedDate(){
		return $this->_updatedDate;
	}
	public function setUpdatedDate($updatedDate){
		$this->_updatedDate =  $updatedDate;
		return $this;
	}
	public function setId($id){
		$this->_id = (int) $id;
		return $this;
	}
	
	public function getId(){
		return $this->_id;
	}
}
?>	







