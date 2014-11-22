<?php

class Application_Form_Services extends ZendX_JQuery_Form
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
        
        /* serviceCode textbox element */
    	$serviceCode = $this->createElement('text', 'serviceCode');
    	$serviceCode->setLabel('Service Code:');
    	$serviceCode->setRequired(TRUE);
    	$serviceCode->setAttrib('size', 50);
    	$this->addElement($serviceCode);
    	
    	/* serviceCategory textbox element */
    	$serviceCategory = $this->createElement('text', 'serviceCategory');
    	$serviceCategory->setLabel('Service Category:');
    	$serviceCategory->setRequired(TRUE);
    	$serviceCategory->setAttrib('size', 70);
    	$this->addElement($serviceCategory);
    	
    	$description = $this->createElement('text', 'description');
    	$description->setLabel('Description:');
    	$description->setRequired(TRUE);
    	$description->setAttrib('size', 70);
    	$this->addElement($description);
    	
    	$planName = $this->createElement('text', 'planName');
    	$planName->setLabel('Plan Name:');
    	$planName->setRequired(TRUE);
    	$planName->setAttrib('size', 70);
    	$this->addElement($planName);
    	
    	$testField = $this->createElement('text', 'textField');
    	$testField->setLabel('Test Field:');
    	$planName->setRequired(FALSE);
    	$planName->setAttrib('size', 70);
    	$this->addElement($testField);
    	
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

