<?php

class Application_Form_Clients extends ZendX_JQuery_Form
{

    public function init()
    {
    	$this->setMethod('post');
    	
    	// create a new element
        $id = $this->createElement('hidden', 'id');
        // element options
        $id->setDecorators(array('ViewHelper'));
        // add the element to the form
        $this->addElement($id);
    	
        /* First name textbox element */
    	$firstName = $this->createElement('text', 'firstName');
    	$firstName->setLabel('First Name:');
    	$firstName->setRequired(TRUE);
    	$firstName->setAttrib('size', 50);
    	$this->addElement($firstName);
    	
    	/* Last name textbox element */
    	$lastName = $this->createElement('text', 'lastName');
    	$lastName->setLabel('Last Name:');
    	$lastName->setRequired(TRUE);
    	$lastName->setAttrib('size', 50);
    	$this->addElement($lastName);
    	
    	/* Middle Name textbox element not required*/
    	$middleName = $this->createElement('text', 'middleName');
    	$middleName->setLabel('Middle Name:');
    	$firstName->setAttrib('size', 50);
    	$this->addElement($middleName);
    	
    	/* Date of Birth DatePicker */
    	$dateOfBirth = new ZendX_JQuery_Form_Element_DatePicker(
                    'dateOfBirth', array("label" => "Date of Birth:"));
        $dateOfBirth->setJQueryParam('dateFormat', 'dd.mm.yy');
        $this->addElement($dateOfBirth);            

        /* Street address textbox required */            
     	$street = $this->createElement('text', 'street');
    	$street->setLabel('Street Address:');
    	$street->setRequired(TRUE);
    	$street->setAttrib('size', 50);
    	$this->addElement($street);
    	
    	/* City textbox required */
    	$city = $this->createElement('text', 'city');
    	$city->setLabel('City:');
    	$city->setRequired(TRUE);
    	$city->setAttrib('size', 50);
    	$this->addElement($city);
    	
    	/* Gender select required */
    	$gender = new Zend_Form_Element_Select('gender');
    	$gender->setLabel('Gender:');
    	$gender->setRequired(TRUE);
    	$gender->addMultiOptions(array(
    			'M' => 'Male',
    			'F' => 'Female'));
    	$this->addElement($gender);
    	
    	/* LanguageSpoken textbox required */
    	$languageSpoken = $this->createElement('text', 'languageSpoken');
    	$languageSpoken->setLabel('Languages Spoken:');
    	$languageSpoken->setRequired(TRUE);
    	$languageSpoken->setAttrib('size', 50);
    	$this->addElement($languageSpoken);
    	
    	/*countryOfOrigin textbox required */
    	$countryOfOrigin = $this->createElement('text', 'countryOfOrigin');
    	$countryOfOrigin->setLabel('Country of Origin:');
    	$countryOfOrigin->setRequired(TRUE);
    	$countryOfOrigin->setAttrib('size', 50);
    	$this->addElement($countryOfOrigin);
    	
    	/* Email text control */ 
    	$email = $this->createElement('text', 'email');
    	$email->setLabel('Email:');
    	$email->setRequired(TRUE);
    	$email->addValidator(new Zend_Validate_EmailAddress());
    	$email->addFilters(array(
    			new Zend_Filter_StringTrim(),
    			new Zend_Filter_StringToLower()));
    	$email->setAttrib('size', 70);
    	$this->addElement($email);
    	
    	/* Home Type multiselect required */
    	$homeType = new Zend_Form_Element_Select('homeType');
    	$homeType->setLabel('Home Type:');
    	$homeType->setRequired(TRUE);
    	$homeType->addMultiOptions(array(
    			'home' => 'Home',
    			'apartment' => 'Apartment',
    			'shelter' => 'Shelter'));
    	$this->addElement($homeType);
    	
    	/* Home Phone textbox not required */
    	$homePhone = $this->createElement('text', 'homePhone');
    	$homePhone->setLabel('Home Phone:');
    	$homePhone->setAttrib('size', 10);
    	$this->addElement($homePhone);
    	
    	/* Cellular Phone textbox not required */
    	$cellPhone = $this->createElement('text', 'cellPhone');
    	$cellPhone->setLabel('Cellular Phone:');
    	$cellPhone->setAttrib('size', 10);
    	$this->addElement($cellPhone);
    	
    	/* Work Phone textbox not required */
    	$workPhone = $this->createElement('text', 'workPhone');
    	$workPhone->setLabel('Work Phone:');
    	$workPhone->setAttrib('size', 10);
    	$this->addElement($workPhone);
    	
    	/*Date of Intake DatePicker required */
    	$dateOfIntake = new ZendX_JQuery_Form_Element_DatePicker(
                    'dateOfIntake', array("label" => "Date of Intake"));
    	$dateOfIntake->setJQueryParam('dateFormat', 'dd.mm.yy');
        $this->addElement($dateOfIntake);
        
       /* Alien Number textbox  not required */
       $alienNumber = $this->createElement('text', 'alienNumber');
       $alienNumber->setLabel('Alien Number:');
       $alienNumber->setAttrib('size', 30);
       $this->addElement($alienNumber);
       
       /* SSN Number textbox  not required */
       $ssn = $this->createElement('text', 'ssn');
       $ssn->setLabel('Social Security Number:');
       $ssn->setAttrib('size', 9);
       $this->addElement($ssn);
       
       /* Immigration Status multiselect required */
    	$immigrationStatus = new Zend_Form_Element_Select('immigrationStatus');
    	$immigrationStatus->setLabel('Immigration Status:');
    	$immigrationStatus->setRequired(TRUE);
    	$immigrationStatus->addMultiOptions(array(
    			'refugee' => 'Refugee',
    			'asyluum' => 'Asyluum',
    			'resident' => 'Resident',
    			'citizen' => 'Citizen',
    			'undocumented' => 'Undocumented'));
    	$this->addElement($immigrationStatus);
    	
    	/* Marital Status multiselect required */
    	$maritalStatus = new Zend_Form_Element_Select('maritalStatus');
    	$maritalStatus->setLabel('Marital Status:');
    	$maritalStatus->setRequired(TRUE);
    	$maritalStatus->addMultiOptions(array(
    			'married' => 'Married',
    			'single' => 'Single',
    			'divorcee' => 'Divorcee'));
    	$this->addElement($maritalStatus);
    	
    	/* Does he depend on somebody (example: Father, Mother)*/
    	$isDependent = new Zend_Form_Element_Select('isDependent');
    	$isDependent->setLabel('Is Dependent:');
    	$isDependent->setRequired(TRUE);
    	$isDependent->addMultiOptions(array(
    			TRUE => 'Yes',
    			FALSE => 'No'));
    	$this->addElement($isDependent);
    	
    	/* Parent SSN or Parent Full Name + Date of Birth is used to get the 
    	 * parentId value in the clients table.
    	 */  
    	
    	/* Parent SSN if he is dependent */
    	$parentssn = $this->createElement('text', 'parentssn');
    	$parentssn->setLabel('Parent SSN:');
    	$parentssn->setAttrib('size', 9);
    	$this->addElement($parentssn);
    	
    	/* Parent fullname if he is dependent */
    	$parentFullName = $this->createElement('text', 'parentFullName');
    	$parentFullName->setLabel('Parent Full Name:');
    	$parentFullName->setAttrib('size', 50);
    	$this->addElement($parentFullName);
    	
    	/* Parent fullname and date of birth if he is dependent */
    	$parentDOB = new ZendX_JQuery_Form_Element_DatePicker(
                    'parentDOB', array("label" => "Parent Date of Birth"));
        $parentDOB->setJQueryParam('dateFormat', 'mm.dd.yy');
        $this->addElement($parentDOB);
    	
    	/* Date of Arrival in USA required*/
    	$dateOfArrival = new ZendX_JQuery_Form_Element_DatePicker(
                    'dateOfArrival', array("label" => "Date of Arrival"));
    	$dateOfArrival->setJQueryParam('dateFormat', 'mm.dd.yy');           
        $this->addElement($dateOfArrival);

        /* Full Name of the emergency Contact */
        $emergencyContactName = $this->createElement('text', 'emergencyContactName');
        $emergencyContactName->setLabel('Name of Emergency Contact:');
        $emergencyContactName->setAttrib('size', 50);
        $this->addElement($emergencyContactName);

        /* Relationship with the emergency contact */
        $contactRelationship = $this->createElement('text', 'contactRelationship');
        $contactRelationship->setLabel('Relationship with Contact:');
        $contactRelationship->setAttrib('size', 50);
        $this->addElement($contactRelationship);
        
        /* Emergency contact phone */
        $contactPhone = $this->createElement('text', 'contactPhone');
        $contactPhone->setLabel('Contact Phone Number:');
        $contactPhone->setAttrib('size', 10);
        $this->addElement($contactPhone);
        
        /* Emergency contact phone type multiselect */
    	$contactPhoneType = new Zend_Form_Element_Select('contactPhoneType');
    	$contactPhoneType->setLabel('Contact Phone Type:');
    	$contactPhoneType->addMultiOptions(array(
    			'home' => 'Home ',
    			'cellular' => 'Cellular',
    			'work' => 'work'));
    	$this->addElement($contactPhoneType);
    	
    	/* ParentId value in the clients table hidden field */
    	$this->addElement('hidden', 'parentId', array(
        				)
		);
    	
    	/* Created Date hidden field */
    	$this->addElement('hidden', 'createdDate', array(
        				)
		);
		
		/* Updated Date hidden field */
    	$this->addElement('hidden', 'updatedDate', array(
        				)
		);
		
		/* Created By hidden field */
    	$this->addElement('hidden', 'createdBy', array(
    	
        				)
		);
		
		/* Updated By hidden field */
    	$this->addElement('hidden', 'updatedBy', array(
        				)
		);
		
		$submit = $this->addElement('submit', 'submit', array('label' => 'Submit'));
		$reset = new Zend_Form_Element_Reset('reset');
		$reset->setLabel('Reset');
		$this->addElement($reset);
    }


}

