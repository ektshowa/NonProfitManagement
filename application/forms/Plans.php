<?php

class Application_Form_Plans extends ZendX_JQuery_Form
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
        
        /* planName textbox element */
    	$planName = $this->createElement('text', 'planName');
    	$planName->setLabel('Plan Name:');
    	$planName->setRequired(TRUE);
    	$planName->setAttrib('size', 50);
    	$this->addElement($planName);
    	
    	/* description textbox element */
    	$description = $this->createElement('text', 'description');
    	$description->setLabel('Decription:');
    	$description->setRequired(TRUE);
    	$description->setAttrib('size', 70);
    	$this->addElement($description);
    	
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

