<?php

class Application_Form_Findclient extends ZendX_JQuery_Form
{

    public function init()
    {
        $this->setMethod('post');
        
        //Input text to get the client
        $clientId = $this->createElement('text', 'clientId');
    	$clientId->setLabel('Enter the client ID here:');
    	$clientId->setRequired(TRUE);
    	$clientId->setAttrib('size', 30);
    	$clientId->setAttrib('id', 'clientId');
    	$clientId->setAttrib('name', 'clientId');
    	$this->addElement($clientId);
    	
    	//$alienNumber = $this->getValue('clientId');
    	
    	//var_dump($alienNumber);
    	
    	//$this->setAction('/clients/findclientdetails/' . $alienNumber);
    	$submit = $this->addElement('submit', 'submit', array('label' => 'Submit'));
    }


}

