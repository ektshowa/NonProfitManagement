<?php

class Application_Form_FindaService extends ZendX_JQuery_Form
{
	public function init(){

		$services = new Application_Model_ServicesMapper();
		$db = $services->getAdapter();
		
		$options = $db->fetchPairs('SELECT id, serviceCode FROM services ORDER BY serviceCode ASC');
	
   		$this->setMethod('post');
        
        //Input text to get the client
        $service = new Zend_Form_Element_Select('selectService', array( 'onchange' => 'getSelectedValue()'));
    	$service->setLabel('Choose the Service:');
    	$service->addMultiOptions($options);
    	$service->setAttrib('id', 'selectService');
    	$service->setAttrib('name', 'serviceCode');
    	$this->addElement($service);
    	
    	//$this->setAction('/clients/findclientdetails/' . $alienNumber);
    	$submit = $this->addElement('submit', 'submit', array('label' => 'Submit'));
	}

}

