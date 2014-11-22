<?php

class Application_Model_Clients
{
	protected $_firstName;
	protected $_lastName;
	protected $_middleName;
	protected $_dateOfBirth;
	protected $_street;
	protected $_city;
	protected $_zipCode;
	protected $_gender;
	protected $_languageSpoken;
	protected $_countryOfOrigin;
	protected $_email;
	protected $_homeType;
	protected $_homePhone;
	protected $_cellPhone;
	protected $_workPhone;
	protected $_dateOfIntake;
	protected $_alienNumber;
	protected $_ssn;
	protected $_immigrationStatus;
	protected $_maritalStatus;
	protected $_isDependent;
	protected $_houseHoldSize;
	protected $_dateOfArrival;
	protected $_emergencyContactName;
	protected $_contactRelationship;
	protected $_contactPhone;
	protected $_contactPhoneType;
	protected $_createdDate;
	protected $_updatedDate;
	protected $_createdBy;
	protected $_updatedBy;
	protected $_parentId;
	protected $_id;
	
	public function __construct(array $options = null){
		if (is_array($options)) {
			$this->setOptions($options);
		}
	}
	
	public function __set($name, $value){
		$method = 'set' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid phone property');
		}
		$this->$method($value);
	}
	
	public function __get($name){
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid phone property');
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
	public function setMiddleName($middleName){
		$this->_middleName = (string) $middleName;
		return $this;
	}
	public function getMiddleName(){
		return $this->_middleName;
	}
	public function setEmail($email){
		$this->_email = (string) $email;
		return $this;
	}
	public function getEmail(){
		return $this->_email;
	}
	public function setDateOfBirth($dateOfBirth){
		$this->_dateOfBirth = $dateOfBirth;
		return $this;
	}
	public function getDateOfBirth(){
		return $this->_dateOfBirth;
	}
	public function setStreet($street){
		$this->_street = (string) $street;
		return $this;
	}
	public function getStreet(){
		return $this->_street;
	}
	public function setCity($city){
		$this->_city = (string) $city;
		return $this;
	}
	public function getCity(){
		return $this->_city;
	}
	public function setZipCode($zipCode){
		$this->_zipCode = (string) $zipCode;
		return $this;
	}
	public function getZipCode(){
		return $this->_zipCode;
	}
	public function setGender($gender){
		$this->_gender = (string) $gender;
		return $this;
	}
	public function getGender(){
		return $this->_gender;
	}
	public function setLanguageSpoken($languageSpoken){
		$this->_languageSpoken = (string) $languageSpoken;
		return $this;
	}
	public function getLanguageSpoken(){
		return $this->_languageSpoken;
	}
	public function setCountryOfOrigin($countryOfOrigin){
		$this->_countryOfOrigin = (string) $countryOfOrigin;
		return $this;
	}
	public function getCountryOfOrigin(){
		return $this->_countryOfOrigin;
	}
	public function getHomeType(){
		return $this->_homePhone;
	}
	public function setHomeType($homeType){
		$this->_homeType = (string) $homeType;
		return $this;
	}
	public function setHomePhone($homePhone){
		$this->_homePhone = (string) $homePhone;
		return $this;
	}
	public function getHomePhone(){
		return $this->_homePhone;
	}
	public function setCellPhone($cellPhone){
		$this->_cellPhone = (string) $cellPhone;
		return $this;
	}
	public function getCellPhone(){
		return $this->_cellPhone;
	}
	public function setWorkPhone($workPhone){
		$this->_workPhone = (string) $workPhone;
		return $this;
	}
	public function getWorkPhone(){
		return $this->_workPhone;
	}
	public function setDateOfIntake($dateOfIntake){
		$this->_dateOfIntake = $dateOfIntake;
		return $this;
	}
	public function getDateOfIntake(){
		return $this->_dateOfIntake;
	}
	public function setAlienNumber($alienNumber){
		$this->_alienNumber = (string) $alienNumber;
		return $this;
	}
	public function getAlienNumber(){
		return $this->_alienNumber;
	}
	public function getSsn(){
		return $this->_ssn;
	}
	public function setSsn($ssn){
		$this->_ssn = (string) $ssn;
		return $this;
	}
	public function setImmigrationStatus($immigrationStatus){
		$this->_immigrationStatus = (string) $immigrationStatus;
		return $this;
	}
	public function getImmigrationStatus(){
		return $this->_immigrationStatus;
	}
	public function setMaritalStatus($maritalStatus){
		$this->_maritalStatus = $maritalStatus;
		return $this;
	}
	public function getMaritalStatus(){
		return $this->_maritalStatus;
	}
	public function setIsDependent($isDependent){
		$this->_isDependent = (boolean) $isDependent;
		return $this;
	}
	public function getIsDependent(){
		return $this->_isDependent;
	}
	public function setHouseHoldSize($houseHoldSize){
		$this->_houseHoldSize = $houseHoldSize;
		return $this;
	}
	public function getHouseHoldSize(){
		return $this->_houseHoldSize;
	}
	public function setDateOfArrival($dateOfArrival){
		$this->_dateOfArrival = $dateOfArrival;
		return $this;
	}
	public function getDateOfArrival(){
		return $this->_dateOfArrival;
	}
	public function getEmergencyContactName(){
		return $this->_emergencyContactName;
	}
	public function setEmergencyContactName($emergencyContactName){
		$this->_emergencyContactName = (string) $emergencyContactName;
		return $this;
	}
	public function getContactRelationship(){
		return $this->_contactRelationship;
	}
	public function setContactRelationship($contactRelationship){
		$this->_contactRelationship = (string) $contactRelationship;
		return $this;
	}
	public function setContactPhone($contactPhone){
		$this->_contactPhone = (string) $contactPhone;
		return $this;
	}
	public function getContactPhone(){
		return $this->_contactPhone;
	}
	public function setContactPhoneType($contactPhoneType){
		$this->_contactPhoneType = (string) $contactPhoneType;
	}
	public function getContactPhoneType(){
		return $this->_contactPhoneType;
	}
	public function getCreatedDate(){
		return $this->_createdDate;
	}
	public function setCreatedDate($createdDate){
		$this->_createdDate = $createdDate;
		return $this;
	}
	public function getCreatedBy(){
		return $this->_createdBy;
	}
	public function setCreatedBy($createdBy){
		$this->_createdBy = (string) $createdBy;
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
		$this->_updatedDate = $updatedDate;
		return $this;
	}
	public function setId($id){
		$this->_id = $id;
		return $this;
	}
	public function getId(){
		return $this->_id;
	}
	public function getParentId(){
		return $this->_parentId;
	}
	public function setParentId($parentId){
		$this->_parentId = $parentId;
		return $this;
	}
}

