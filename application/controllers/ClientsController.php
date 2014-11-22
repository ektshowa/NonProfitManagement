<?php

class ClientsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function createAction()
    {
        $form = new Application_Form_Clients();
		if ($this->_request->isPost()) {
			if ($form->isValid($_POST)) {
				$clientsMapper  = new Application_Model_ClientsMapper();
				$newClient = new Application_Model_Clients();
				
				$newClient->setFirstName($form->getValue('firstName'));
				$newClient->setLastName($form->getValue('lastName'));
				$newClient->setMiddleName($form->getValue('middleName'));
				$newClient->setDateOfBirth($form->getValue('dateOfBirth'));
				$newClient->setStreet($form->getValue('street'));
				$newClient->setCity($form->getValue('city'));
				$newClient->setGender($form->getValue('gender'));
				$newClient->setLanguageSpoken($form->getValue('languageSpoken'));
				$newClient->setCountryOfOrigin($form->getValue('countryOfOrigin'));
				$newClient->setEmail($form->getValue('email'));
				$newClient->setHomeType($form->getValue('homeType'));
				$newClient->setHomePhone($form->getValue('homePhone'));
				$newClient->setCellPhone($form->getValue('cellPhone'));
				$newClient->setWorkPhone($form->getValue('workPhone'));
				$newClient->setDateOfIntake($form->getValue('dateOfIntake'));
				$newClient->setAlienNumber($form->getValue('alienNumber'));
				$newClient->setSsn($form->getValue('ssn'));
				$newClient->setImmigrationStatus($form->getValue('immigrationStatus'));
				$newClient->setMaritalStatus($form->getValue('maritalStatus'));
				$newClient->setIsDependent($form->getValue('isDependent'));
				$newClient->setHouseHoldSize($form->getValue('householdSize'));
				$newClient->setDateOfArrival($form->getValue('dateOfArrival'));
				$newClient->setEmergencyContactName($form->getValue('emergencyContactName'));
				$newClient->setContactRelationship($form->getValue('contactRelationship'));
				$newClient->setContactPhone($form->getValue('contactPhone'));
				$newClient->setContactPhoneType($form->getValue('contactPhoneType'));
				
				$clientsMapper->save($newClient);
				
				//return $this->_helper->redirector('index');
			}
		}
		$form->setAction('/clients/create');
		$this->view->form = $form;
    }

    public function listAction()
    {
        $clients = new Application_Model_ClientsMapper();
        $this->view->entries = $clients->fetchAll();
    }

    public function updateAction()
    {
       $clientForm = new Application_Form_Clients();
        
        // Connect the form to the related action 
        $clientForm->setAction('/clients/update');
        
        // Use the getter and setter method from the Clents Model to
        // to manipulate the form fields. Each Model property correspond to a table column 
        $clientModel = new Application_Model_Users();
        
        $clients = new Application_Model_ClentsMapper();
        
        if ($this->_request->isPost()){
        	
        	if ($clientForm->isValid($_POST)){
        		$clientModel->setFisrtName($clientForm->getValue('firstName'));
        		$clientModel->setLastName($clientForm->getValue('lastName'));
        		$clientModel->setMiddleName($clientForm->getValue('middleName'));
        		$clientModel->setEmail($clientForm->getValue('email'));
        		$clientModel->setDateOfBirth($clientForm->getValue('dateOfBirth'));
        		$clientModel->setStreet($clientForm->getValue('street'));
        		$clientModel->setCity($clientForm->getValue('city'));
        		$clientModel->setZipCode($clientForm->getValue('zipCode'));
        		$clientModel->setGender($clientForm->getValue('gender'));
        		$clientModel->setLanguageSpoken($clientForm->getValue('languageSpoken'));
        		$clientModel->setCountryOfOrigin($clientForm->getValue('countryOfOrigin'));
        		$clientModel->setHomeType($clientForm->getValue('homeType'));
        		$clientModel->setHomePhone($clientForm->getValue('homePhone'));
        		$clientModel->setCellPhone($clientForm->getValue('cellPhone'));
        		$clientModel->setWorkPhone($clientForm->getValue('workPhone'));
        		$clientModel->setDateOfIntake($clientForm->getValue('dateOfIntake'));
        		$clientModel->setAlienNumber($clientForm->getValue('alienNumber'));
        		$clientModel->setSsn($clientForm->getValue('ssn'));
        		$clientModel->setImmigrationStatus($clientForm->getValue('immigrationStatus'));
        		$clientModel->setMaritalStatus($clientForm->getValue('maritalStatus'));
        		$clientModel->setIsDependent($clientForm->getValue('isDependent'));
        		$clientModel->setHouseHoldSize($clientForm->getValue('houseHoldSize'));
        		$clientModel->setDateOfArrival($clientForm->getValue('dateOfArrival'));
        		$clientModel->setEmergencyContactName($clientForm->getValue('emergencyContactName'));
        		$clientModel->setContactRelationship($clientForm->getValue('contactRelationship'));
        		$clientModel->setContactPhone($clientForm->getValue('contactPhone'));
        		$clientModel->setContactPhoneType($clientForm->getValue('contactPhoneType'));
        		$clientModel->setUpdatedDate($clientForm->getValue('updatedDate'));
        		$clientModel->setUpdatedBy($clientForm->getValue('updatedBy'));
        		$clientModel->setId($clientForm->getValue('id'));
        		$clients->save($clientModel);
        		return $this->_forward('list');
        	}
        }
        else {
        	//Get the id value from the form 
        	$id = $this->_request->getParam('id');
        	
        	// Find the row and populate the form
        	$currentClient = $clients->find($id, $clientModel);
        	$clientForm->populate($currentClient->toArray());	
        }
        $this->view->form = $clientForm; 
       
       
    }

    public function findclientdetailsAction()
    {
    	$findClientForm = new Application_Form_Findclient();
    	
    	//Get the alienNumber value from the form 
        //$alienNumber = $findClientForm->getValue('clientId');
        $alienNumber = $this->_request->getParam('clientId');
        
        $clients = new Application_Model_ClientsMapper();
        $this->view->clientEntry = $clients->fetchAClient($alienNumber);
        // var_dump($clients->fetchNeedsassessments($alienNumber));
        $this->view->needsEntries = $clients->fetchNeedsassessments($alienNumber);
        $this->view->followupEntries = $clients->fetchFollowup($alienNumber);
        
    }

    public function findaclientAction()
    {
        $findClientForm = new Application_Form_Findclient();
        
        if ($this->_request->isPost()) {
			if ($findClientForm->isValid($_POST)) {
				$clientId = $findClientForm->getValue('clientId');
				$this->_redirect('clients/findclientdetails/clientId/' . $clientId);
		    }
  
        }
        $this->view->form = $findClientForm;
    }

}













