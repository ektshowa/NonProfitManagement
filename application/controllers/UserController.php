<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        /* Get the current instance of Zend_Auth
         * If the user is log in, an identity is set
         */
    	$auth = Zend_Auth::getInstance();
    	
    	if ($auth->hasIdentity()){
    		$this->view->identity = $auth->getIdentity();
    		//var_dump($auth->getIdentity());
    	}
    	
    }
    
    public function createAction()
    {
        $userForm = new Application_Form_User();
        if ($this->_request->isPost()){
        	if ($userForm->isValid($_POST)){
        		$users = new Application_Model_UsersMapper();
        		$newUser = new Application_Model_Users();
        		$newUser->setEmail($userForm->getValue('email'));
                        $newUser->setRoleId($userForm->getValue('roleId'));
        		$newUser->setFirstName($userForm->getValue('firstName'));
        		$newUser->setLastName($userForm->getValue('lastName'));
        		$newUser->setMiddleName($userForm->getValue('middleName'));
        		$newUser->setUsername($userForm->getValue('username'));
        		$newUser->setPassword($userForm->getValue('password'));
                        
        		
        		/* Check here that the username is unique in the database */
        		
        		$users->save($newUser);
        	}
        }
        
        $userForm->setAction('/user/create');
        $this->view->form = $userForm;
    }

    public function listAction()
    {
        $users = new Application_Model_UsersMapper();
        $this->view->entries = $users->fetchAll();
        
        
    }

    public function updateAction()
    {
        $userForm = new Application_Form_User();
        
        // Connect the form to the related action 
        $userForm->setAction('/user/update');
        
        // Remove the password because it was encrypted using 
        // one-way encryption. I cannot just fetch the value and populate
        // the password field.
        $userForm->removeElement('password');
        
        // Use the getter and setter method from the Users Model to
        // to manipulate the form fields. Each Model property correspond to a table column 
        $usersModel = new Application_Model_Users();
        
        $users = new Application_Model_UsersMapper();
        
        //Get the id value from the form 
        $id = $this->_request->getParam('id');
        	
        // Find the row and populate the form
        $currentUser = $users->find($id, $usersModel);
        $userForm->populate($currentUser->toArray());	
        
        $this->view->form = $userForm; 
    }

    public function passwordAction()
    {
    	// Remove all elements from the form except id and password
        $passwordForm = new Application_Form_User();
        $passwordForm->setAction('/user/password');
        $passwordForm->removeElement('firstName');
        $passwordForm->removeElement('lastName');
        $passwordForm->removeElement('middleName');
        $passwordForm->removeElement('email');
        $passwordForm->removeElement('username');
        
        $users = new Application_Model_UsersMapper();
        
        // If it is a postback populate the form
        if ($this->_request->isPost()){
        	if ($passwordForm->isValid($_POST)){
        		$users->updatePassword($passwordForm->getValue('id'), $passwordForm->getValue('password'));
        		return $this->_forward('list');
        	}
        	
        }
        else{
        	$id = $this->_request->getParam('id');
        	$currentUser = $users->getDbTable()->find($id)->current();
        	$passwordForm->populate($currentUser->toArray());
        }
        $this->view->form = $passwordForm;
    }

    public function deleteAction()
    {
    	$id = $this->_request->getParam('id');
    	$user = new Application_Model_UsersMapper();
    	$user->deleteUser($id);
    	return $this->_forward('list');
    }

    public function loginAction()
    {
        $userForm = new Application_Form_User();
        $userForm->setAction('/user/login');
        $userForm->removeElement('firstName');
        $userForm->removeElement('lastName');
        $userForm->removeElement('email');
        $userForm->removeElement('middleName');
        $userForm->removeElement('passwordConfirm');
        $userForm->removeElement('roleId');
        
        if ($this->_request->isPost() && $userForm->isValid($_POST)){
        	$data = $userForm->getValues();
        	//set up the auth adapter. get the default db adapter 
        	//$db = Zend_Db_Table::getDefaultAdapter();
        	
      /*  	$db = Zend_Db::factory('Pdo_Mysql', array(
                                                'host'     => 'localhost',
                                                'username' => 'root',
                                                'password' => '',
                                                'dbname'   => 'nonprofit'
                                            ));
        	
        	
        	$authAdapter = new Zend_Auth_Adapter_DbTable($db);
        	
        	$authAdapter->setTableName('users');
        	$authAdapter->setIdentityColumn('username');
        	$authAdapter->setCredentialColumn('password');
        	
        	//set the username and password
        	$authAdapter->setIdentity($data['username']);
        	$authAdapter->setCredential(md5($data['password']));
        	
        	//authenticate
        	$auth = Zend_Auth::getInstance();
        	$result = $auth->authenticate($authAdapter);  */
                                            
            // create the auth adapter
            $db = Zend_Db_Table::getDefaultAdapter();
        	$authAdapter = new Zend_Auth_Adapter_DbTable($db, 'users', 'username', 'password');
        	
        	$authAdapter->setIdentity($data['username']);
        	//$authAdapter->setCredential($data['password']);
        	//var_dump(md5($data['password']));
        	
        	$authAdapter->setCredential(md5($data['password']));
        	
        	$result = $authAdapter->authenticate();
                                            
        	if ($result->isValid()){
        		//store the username, email, first, middlename, and last names of the user
        		
        		$auth = Zend_Auth::getInstance();
        		$storage = $auth->getStorage();
        		$storage->write($authAdapter->getResultRowObject( 
        				array('username', 'firstName', 'lastName', 'email', 'roleId')));
        			
        		//$this->view->storedIdentity = $storage;
        				
        		return $this->_forward('index');
        		//$this->_helper->redirector->gotoRoute(array(
   				//	'controller'=> 'user',
   				//	'action' =>'index'));
        	}
        	else {
        		$this->view->loginMessage = "Sorry, your username or password is incorrect";
        	}	
        }
        $this->view->form = $userForm;
    }

    public function logoutAction()
    {
        $authAdapter = Zend_Auth::getInstance();
        $authAdapter->clearIdentity();
    }


}

?>













