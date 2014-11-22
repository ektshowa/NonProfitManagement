<?php

class Application_Form_Findaplan extends ZendX_JQuery_Form
{

    public function init()
    {
        $this->setMethod('post');
        
        //Input text to get the plan
        $planName = $this->createElement('text', 'planName');
    	$planName->setLabel('Enter the Plan Name here:');
    	$planName->setRequired(TRUE);
    	$planName->setAttrib('size', 30);
    	$planName->setAttrib('id', 'planName');
    	$planName->setAttrib('name', 'planName');
    	$this->addElement($planName);
    	
    	$submit = $this->addElement('submit', 'submit', array('label' => 'Submit'));
    }


}
