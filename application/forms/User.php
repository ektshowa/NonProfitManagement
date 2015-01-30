<script>
    
</script>    
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
        
        $password = $this->createElement('password', 'password');
        $password->setLabel('Password: ');
        $password->setRequired('true');
        $this->addElement($password);
        
        $passwordConfirm = $this->createElement('password', 'passwordConfirm');
        $passwordConfirm->setLabel('Password Confirm: ');
        $passwordConfirm->setRequired('true');
       // $passwordConfirm->addPrefixPath("ManageNonProfit_Validate", "ManageNonProfit/Validate", "validate");
       // $passwordConfirm->addValidator(new Application_ManageNonProfit_Validate_PasswordConfirm());
        $this->addElement($passwordConfirm);
        
        $role = $this->createElement('select', 'roleId');
        $role->setLabel('Select a role: ');
        $role->addMultiOption(4, 'User');
        $role->addMultiOption(3, 'Case Manager');
        $role->addMultiOption(2, 'Administrator');
        $role->addMultiOption(1, 'System Administrator');
        $role->setRequired('true');
        $this->addElement($role);
        
        // The Username is generated with concatanation of the first letter of firstName
        // and lastName
        $username = $this->createElement('text', 'username');
        $username->setLabel('Username: ');
        $this->addElement($username);
        
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

