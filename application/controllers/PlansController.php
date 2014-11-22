<?php

class PlansController extends Zend_Controller_Action
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
        $planForm = new Application_Form_Plans();
        if ($this->_request->isPost()){
        	if ($planForm->isValid($_POST)){
        		$plans = new Application_Model_PlansMapper();
        		$newPlan = new Application_Model_Plans();
        		$newPlan->setPlanName($planForm->getValue('planName'));
        		$newPlan->setDescription($planForm->getValue('description'));
        	
        		$plans->save($newPlan);
        	}
        }
        
        $planForm->setAction('/plans/create');
        $this->view->form = $planForm;    	
    }

    public function listAction()
    {
    	$plans = new Application_Model_PlansMapper();  
        $this->view->entries = $plans->fetchAll();
    }

    public function updateAction()
    {
        $planForm = new Application_Form_Plans();
        
        // Connect the form to the related action 
        $planForm->setAction('/plan/update');
        
        
        // Use the getter and setter method from the Plans Model to
        // to manipulate the form fields. Each Model property correspond to a table column 
        $plansModel = new Application_Model_Plans();
        
        $plans = new Application_Model_PlansMapper();
        
        if ($this->_request->isPost()){
        	
        	if ($planForm->isValid($_POST)){
        		$plansModel->setplanName($planForm->getValue('planName'));
        		$plansModel->setDescription($planForm->getValue('description'));
        		$plansModel->setId($planForm->getValue('id'));
        		$plans->save($plansModel);
        		return $this->_forward('list');
        	}
        }
        else {
        	//Get the id value from the form 
        	$id = $this->_request->getParam('id');
        	
        	// Find the row and populate the form
        	$currentPlan = $plans->find($id, $plansModel);
                $this->view->mplan = $currentPlan; 
                
                if (!$currentPlan || !$currentPlan instanceof Application_Model_Plans)
                {
                     $this->view->message = "Could not find the Plan ID " . $id;
                }
                else
                {
                    $currentPlanArray = Array();
                    $currentPlanArray["planName"] = $currentPlan->getPlanName();
                    $currentPlanArray["description"] = $currentPlan->getDescription();
                                        
                    if  (is_array($currentPlanArray))
                    {
                        $this->view->thePlanName = $currentPlanArray["planName"];
                        $planForm->populate($currentPlanArray);
                    }
                    else
                    {
                        $this->view->message = "Could Not populate the view.";
                    }
                }
        }
        $this->view->form = $planForm; 
    }

    public function findaplanAction()
    {
    	$findplanForm = new Application_Form_Findaplan();
        
        if ($this->_request->isPost()) {
			if ($findplanForm->isValid($_POST)) {
				$planName = $findplanForm->getValue('planName');
				$this->_redirect('plans/findplandetails/planName/' . $planName);
		    }
  
        }
        $this->view->form = $findplanForm;
    }

    public function findplandetailsAction()
    {
        $planName = $this->_request->getParam('planName');
        $plans = new Application_Model_PlansMapper();
        $this->view->planEntry = $plans->fetchAPlan($planName);
        $this->view->servicesEntries = $plans->fetchServices($planName);
    }


}













