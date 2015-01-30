<?php

class RolesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }
/*
    public function indexAction()
    {
        // action body
    }
    
    public function createAction()
    {
        $roleForm = new Application_Form_Role();
        $user = new Application_Model_UsersMapper();
        
        if ($this->_request->isPost()){
        	if ($roleForm->isValid($_POST)){
                        $currentUser = $user->find($_SESSION["userId"]) 
        		$newUser = new Application_Model_Users();
        		$newUser->setEmail($userForm->getValue('email'));
                        $newUser->setRole($userForm->getValue('role'));
        		$newUser->setFirstName($userForm->getValue('firstName'));
        		$newUser->setLastName($userForm->getValue('lastName'));
        		$newUser->setMiddleName($userForm->getValue('middleName'));
        		$newUser->setUsername($userForm->getValue('username'));
        		$newUser->setPassword($userForm->getValue('password'));
                        
        		
        		/* Check here that the username is unique in the database 
        		
        		$users->save($newUser);
        	}
        }
        
        $userForm->setAction('/user/create');
        $this->view->form = $userForm;
    } */



}

