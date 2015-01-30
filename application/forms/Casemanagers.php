<?php

class Application_Form_Casemanagers extends ZendX_JQuery_Form
{

    public function init()
    {
    	$this->setMethod('post');
    	
        // create a new element
        /* Record ID hidden field */
        $id = $this->createElement('hidden', 'id');
        // element options
        $id->setDecorators(array('ViewHelper'));
        // add the element to the form
        $this->addElement($id);
    	
        /* UserID hidden field */
        $userID = $this->createElement('hidden', 'userID');
        // element options
        $userID->setDecorators(array('ViewHelper'));
        // add the element to the form
        $this->addElement($userID);
    	
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
    }


}

