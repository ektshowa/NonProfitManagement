<?php

class ServicesController extends Zend_Controller_Action
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
        $serviceForm = new Application_Form_Services();
        if ($this->_request->isPost()){
        	if ($serviceForm->isValid($_POST)){
        		$services = new Application_Model_ServicesMapper();
        		$newService = new Application_Model_Services();
        		
        		// Find the planId from the planName entered in the form
        		$planName = $serviceForm->getValue('planName');
        		$planRow  = $services->findPlanId($planName);
        		$planId = $planRow[$planName];
        		
        		$newService->setPlanId($planId);
        		$newService->setDescription($serviceForm->getValue('description'));
        		$newService->setServiceCategory($serviceForm->getValue('serviceCategory'));
        		$newService->setServiceCode($serviceForm->getValue('serviceCode'));
        		
        		$services->save($newService);
        	}
        }
        
        $serviceForm->setAction('/services/create');
        $this->view->form = $serviceForm;
    }

    public function listAction()
    {
        $services = new Application_Model_ServicesMapper();
        
        $this->view->entries = $services->fetchFullRows();
    }

    public function findaserviceAction()
    {
       $findServiceForm = new Application_Form_FindaService();
        var_dump($findServiceForm->getValues());
        if ($this->_request->isPost()) {
      		
			if ($findServiceForm->isValid($_POST)) {
				$serviceCode = $findServiceForm->getValue('serviceCode');
				$this->_redirect('services/findservicedetails/serviceCode/' . $serviceCode);
		    }
  
        }
        $this->view->form = $findServiceForm;
    }

    public function findservicedetailsAction()
    {
        $findaServiceForm = new Application_Form_FindaService();
    	
    	//Get the serviceCode value from the form 
        $serviceCode = $this->_request->getParam('serviceCode');
        
        $services = new Application_Model_ServicesMapper();
        $this->view->serviceEntry = $services->fetchAService($serviceCode);
        //$this->view->needsEntries = $clients->fetchNeedsassessments($alienNumber);
        //$this->view->followupEntries = $clients->fetchFollowup($alienNumber);
    }


}











