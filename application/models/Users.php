<?php

class Application_Model_Users {
	protected $_firstName;
	protected $_lastName;
	protected $_middleName;
	protected $_username;
	protected $_password;
	protected $_email;
        protected $_role;
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
			throw new Exception('Invalid User property');
		}
		$this->$method($value);
	}
	
	public function __get($name){
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid User property');
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
	
	public function setFirstName($firstName){
		$this->_firstName = (string) $firstName;
		return $this;
	}
	
	public function getFirstName(){
		return $this->_firstName;
	}
	
	public function setLastName($lastName){
		$this->_lastName = (string) $lastName;
		return $this;
	}
	public function getLastName(){
		return $this->_lastName;
	}
	public  function setMiddleName($middleName){
		$this->_middleName = (string) $middleName;
		return  $this;
	}
	public function getMiddleName(){
		return $this->_middleName;
	}
	public function setUsername($username){
		$this->_username = $username;
		return $this;
	}
	public function getUsername(){
		return $this->_username;
	}
	public function setEmail($email){
		$this->_email = (string) $email;
		return $this;
	}
	public function getEmail(){
		return $this->_email;
	}
        public function setRoleId($roleId){
		$this->_role = (string) $roleId;
		return $this;
	}
	public function getRoleId(){
		return $this->_role;
	}
	public function setPassword($password){
		$this->_password = (string) $password;
		return $this;
	}
	public function getPassword(){
		return $this->_password;
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




