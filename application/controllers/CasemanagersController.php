<?php

class CasemanagersController extends Zend_Controller_Action
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
        $casemanagerForm = new Application_Form_Casemanagers();
        if ($this->_request->isPost()){
        	if ($casemanagerForm->isValid($_POST)){
        		$casemanagers = new Application_Model_CasemanagersMapper();
        		$newCasemanager = new Application_Model_Casemanagers();
                        $newUser = new Application_Model_Users();
                        $user = new Application_Model_UsersMapper();
                        $email = $casemanagerForm->getValue('email');
                        $emailParts = explode("@",$email);
                        $username = $emailParts[0];
                        $newUser->setEmail($email);
                        $newUser->setFirstName($casemanagerForm->getValue('firstName'));
                        $newUser->setLastName($casemanagerForm->getValue('lastName'));
                        $newUser->setMiddleName($casemanagerForm->getValue('middleName'));
                        $newUser->setRole("casemanager");
                        $newUser->setUsername($username);
                        $newUserID = $user->save($newUser);
                        
                        $newCasemanager->setUserID($newUserID);
        		$casemanagers->save($newCasemanager);
                        
                    /*	$newUser->setEmail($casemanagerForm->getValue('email'));
        		$newCasemanager->setFirstName($casemanagerForm->getValue('firstName'));
        		$newCasemanager->setLastName($casemanagerForm->getValue('lastName'));
        		$newCasemanager->setMiddleName($casemanagerForm->getValue('middleName'));
                    */
                        //$userID = $casemanagerForm->getValue('userID');          
        	}
        }
        
        $casemanagerForm->setAction('/casemanagers/create');
        $this->view->form = $casemanagerForm;
    }

    public function listAction()
    {
        $casemanagers = new Application_Model_CasemanagersMapper();
     
        $this->view->entries = $casemanagers->fetchAll();
        
    }

    public function updateAction()
    {
		$casemanagerForm = new Application_Form_Casemanagers();
        
        // Connect the form to the related action 
        $casemanagerForm->setAction('/casemanager/update');
        
        // Use the getter and setter method from the Casemanagers Model to
        // to manipulate the form fields. Each Model property correspond to a table column 
        $casemanagersModel = new Application_Model_Casemanagers();
        
        $casemanagers = new Application_Model_CasemanagersMapper();
        
        if ($this->_request->isPost()){
        	
        	if ($casemanagerForm->isValid($_POST)){
        		/*$casemanagersModel->setFisrtName($casemanagerForm->getValue('firstName'));
        		$casemanagersModel->setLastName($casemanagerForm->getValue('lastName'));
        		$casemanagersModel->setMiddleName($casemanagerForm->getValue('middleName'));
        		$casemanagersModel->setEmail($casemanagerForm->getValue('email'));
                        */
        		$casemanagersModel->setId($casemanagerForm->getValue('id'));
                        $casemanagersModel->setUserID($casemanagerForm->getValue('userID'));
        		$casemanagers->save($casemanagersModel);
        		return $this->_forward('list');
        	}
        }
        else {
        	//Get the id value from the form 
        	$id = $this->_request->getParam('id');
        	
        	// Find the row and populate the form
        	$currentCasemanager = $casemanagers->find($id, $casemanagersModel);
        	$casemanagerForm->populate($currentCasemanager->toArray());	
        }
        $this->view->form = $casemanagerForm; 
  
    }


}









