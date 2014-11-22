<?php

class Application_Form_Followup extends ZendX_JQuery_Form
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
        
        /* Client ID Number textbox element */
    	$clientAlienNumber = $this->createElement('text', 'clientIdNumber');
    	$clientAlienNumber->setLabel('Client ID Number:');
    	$clientAlienNumber->setRequired(TRUE);
    	$clientAlienNumber->setAttrib('size', 50);
    	$this->addElement($clientAlienNumber);
    	
    	/* Case Manager email textbox element */
    	$managerEmail = $this->createElement('text', 'managerEmail');
    	$managerEmail->setLabel('Case Manager Email:');
    	$managerEmail->setRequired(TRUE);
    	$managerEmail->setAttrib('size', 50);
    	$this->addElement($managerEmail);
    	
        /* planName textbox element */
    	$planName = $this->createElement('text', 'planName');
    	$planName->setLabel('Plan Name:');
    	$planName->setRequired(TRUE);
    	$planName->setAttrib('size', 50);
    	$this->addElement($planName);
    	
    	/*  textbox element */
    	$serviceCode = $this->createElement('text', 'serviceCode');
    	$serviceCode->setLabel('Service Code:');
    	$serviceCode->setRequired(TRUE);
    	$serviceCode->setAttrib('size', 50);
    	$this->addElement($serviceCode);
    	
    	/* Action Taken textbox element */
    	$actionTaken = $this->createElement('text', 'actionTaken');
    	$actionTaken->setLabel('Action Taken:');
    	$actionTaken->setRequired(TRUE);
    	$actionTaken->setAttrib('size', 50);
    	$this->addElement($actionTaken);
    	
    	/* Date of Action element */
    	$dateOfAction = $this->createElement('text', 'dateOfAction');
    	$dateOfAction->setLabel('Date of Action:');
    	$dateOfAction->setRequired(TRUE);
    	$dateOfAction->setAttrib('size', 50);
    	$this->addElement($dateOfAction);
    
    	/* Comments textarea element */
    	$comments = $this->createElement('textarea', 'comments');
    	$comments->setLabel('Comments:')
    			 ->setRequired(TRUE)
    			 ->setAttrib('cols', 70)
    			 ->setAttrib('rows', 5);
    	$this->addElement($comments);
    	
    	
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

