<?php

class Application_Form_Needsassessments extends ZendX_JQuery_Form
{

    public function init()
    {
    	$this->setMethod('post');
    	
        // id hidden field
        $id = $this->createElement('hidden', 'id');
        // element options
        $id->setDecorators(array('ViewHelper'));
        // add the element to the form
        $this->addElement($id);
        
        /* ssn textbox element */
    	$alienNumber = $this->createElement('text', 'alienNumber');
    	$alienNumber->setLabel('Client Alien Number:');
    	$alienNumber->setRequired(TRUE);
    	$alienNumber->setAttrib('size', 50);
    	$this->addElement($alienNumber);
    	
    	/* Service code select required */
    	$serviceCode = new Zend_Form_Element_Select('serviceCode');
    	$serviceCode->setLabel('Service Code:');
    	$serviceCode->setRequired(TRUE);
    	$serviceCode->addMultiOptions(array(
    			's001' => 'First Service',
    			's004' => 'Second Service'));
    	$this->addElement($serviceCode);
    	
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
    	$reset = $this->addElement('reset', 'reset', array('label' => 'Reset'));
    }


}


