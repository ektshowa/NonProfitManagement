<?php

class Application_Form_User extends ZendX_JQuery_Form
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
        
        $username = $this->createElement('text', 'username');
        $username->setLabel('Username: ');
        $username->setRequired('true');
        $username->addFilter('stripTags');
        $username->addErrorMessage('The username is required');
        $this->addElement($username);
        
        $password = $this->createElement('password', 'password');
        $password->setLabel('Password: ');
        $password->setRequired('true');
        $this->addElement($password);
        
        $firstName = $this->createElement('text', 'firstName');
        $firstName->setLabel('First Name: ');
        $firstName->setRequired('true');
        $firstName->addFilter('stripTags');
        $this->addElement($firstName);
        
        $lastName = $this->createElement('text', 'lastName');
        $lastName->setLabel('Last Name: ');
        $lastName->setRequired('true');
        $lastName->addFilter('stripTags');
        $this->addElement($lastName);
        
        $email = $this->createElement('text', 'email');
    	$email->setLabel('Email:');
    	$email->setRequired('true');
    	$email->addValidator(new Zend_Validate_EmailAddress());
    	$email->addFilters(array(
    			new Zend_Filter_StringTrim(),
    			new Zend_Filter_StringToLower()));
    	$email->setAttrib('size', 70);
    	$this->addElement($email);
        
        $role = $this->createElement('select', 'role');
        $role->setLabel('Select a role: ');
        $role->addMultiOption('User', 'user');
        $role->addMultiOption('Administrator', 'administrator');
        $role->setRequired('true');
        $this->addElement($role);
    	
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

