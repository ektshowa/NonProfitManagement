<?php

class NeedsassessmentsController extends Zend_Controller_Action
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
    	$needsassessmentsForm = new Application_Form_Needsassessments();
        	if ($this->_request->isPost()){
        		if ($needsassessmentsForm->isValid($_POST)){
        			$needsassessments = new Application_Model_NeedsassessmentsMapper();
        			$newNeedsassessment = new Application_Model_Needsassessments();
        		
        			// Find the serviceId from the serviceCode entered in the form
        			$serviceCode = $needsassessmentsForm->getValue('serviceCode');
        			$service = $needsassessments->findServiceId($serviceCode);
        			$serviceId = $service[$serviceCode];
        			 
        			// Find the clientId from the ssn entered in the form
        			$alienNumber = $needsassessmentsForm->getValue('alienNumber');
        			$service = $needsassessments->findClientId($alienNumber);
        			$clientId = $service[$alienNumber];
        			
        			$newNeedsassessment->setClientId($clientId);
        			$newNeedsassessment->setServiceId($serviceId);
        			$newNeedsassessment->setComments($needsassessmentsForm->getValue('comments'));
        			
            		$needsassessments->save($newNeedsassessment);
        		}
        	}
        $needsassessmentsForm->setAction('/needsassessments/create');
		$this->view->form = $needsassessmentsForm;
    }

    public function listAction()
    {
       $needsAssessments = new Application_Model_NeedsassessmentsMapper();
       $this->view->entries = $needsAssessments->fetchFullRows();
    }


}







