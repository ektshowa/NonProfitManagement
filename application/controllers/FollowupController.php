<?php

class FollowupController extends Zend_Controller_Action
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
    	$followupForm = new Application_Form_Followup();
        	if ($this->_request->isPost()){
        		if ($followupForm->isValid($_POST)){
        			$followups = new Application_Model_FollowupMapper();
        			$newFollowup = new Application_Model_Followups();
        		
        			// Find the serviceId from the serviceCode entered in the form
        			$serviceCode = $followupForm->getValue('serviceCode');
        			$service = $followups->findServiceId($serviceCode);
        			$serviceId = $service[$serviceCode];
        			 
        			// Find the clientId from the client ID entered in the form
        			$clientIdNumber = $followupForm->getValue('clientIdNumber');
        			$client = $followups->findClientId($clientIdNumber);
        			$clientId = $client[$clientIdNumber];
        			
        			// Find the casemanagerId from the case manager email entered in the form
        			$caseManagerEmail = $followupForm->getValue('managerEmail');
        			$caseManagerId = $followups->findCaseManagerId($caseManagerEmail);
        			
        			// Find the planId from the plan name entered in the form
        			$planName = $followupForm->getValue('planName');
        			$plan = $followups->findPlanId($planName);
        			$planId = $plan[$planName];
        			
        			$newFollowup->setClientId($clientId);
        			$newFollowup->setServiceId($serviceId);
        			$newFollowup->setCaseManagerId($caseManagerId);
        			$newFollowup->setPlanId($planId);
        			$newFollowup->setActionTaken($followupForm->getValue('actionTaken'));
        			$newFollowup->setDateOfAction($followupForm->getValue('dateOfAction'));
        			$newFollowup->setComments($followupForm->getValue('comments'));
        			
            		$followups->save($newFollowup);
        		}
        	}
        $followupForm->setAction('/followup/create');
		$this->view->form = $followupForm;    }


}





