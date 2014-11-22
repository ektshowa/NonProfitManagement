<?php

class Application_Model_Services {
	protected $_serviceCode;
	protected $_description;
	protected $_serviceCategory;
	protected $_planId;
	protected $_planName;
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
			throw new Exception('Invalid service property');
		}
		$this->$method($value);
	}
	
	public function __get($name){
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid service property');
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
	
	public function setServiceCode($serviceCode){
		$this->_serviceCode = (string) $serviceCode;
		return $this;
	}
	
	public function getServiceCode(){
		return $this->_serviceCode;
	}
	public function setServiceCategory($serviceCategory){
		$this->_serviceCategory = (string) $serviceCategory;
		return $this;
	}
	
	public function getServiceCategory(){
		return $this->_serviceCategory;
	}
	public function setDescription($description){
		$this->_description = (string) $description;
		return $this;
	}
	public function getDescription(){
		return $this->_description;
	}
	public function setPlanId($planId){
		$this->_planId = (integer) $planId;
		return $this;
	}
	public function getPlanId(){
		return $this->_planId;
	}
	public function setPlanName($planName){
		$this->_planName = (string) $planName;
		return $this;
	}
	public function getPlanName(){
		return $this->_planName;
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







