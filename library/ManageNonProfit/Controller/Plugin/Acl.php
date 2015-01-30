<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ManageNonProfit_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract {
    
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        // Set up acl
        $acl = new Zend_Acl();
        
        // Add the roles
        $acl->addRole(new Zend_Acl_Role(4));
        $acl->addRole(new Zend_Acl_Role(3));
        $acl->addRole(new Zend_Acl_Role(2));
        $acl->addRole(new Zend_Acl_Role(1));
        
        // Add the resources
        $acl->add(new Zend_Acl_Resource('casemanagers'));
        $acl->add(new Zend_Acl_Resource('clients'));
        $acl->add(new Zend_Acl_Resource('error'));
        $acl->add(new Zend_Acl_Resource('followup'));
        $acl->add(new Zend_Acl_Resource('index'));
        $acl->add(new Zend_Acl_Resource('needsassessments'));
        $acl->add(new Zend_Acl_Resource('plans'));
        $acl->add(new Zend_Acl_Resource('roles'));
        $acl->add(new Zend_Acl_Resource('services'));
        $acl->add(new Zend_Acl_Resource('user'));
        
        // Set up the access rules
        $acl->allow(null, array('index', 'error'));
        
        // Administrators can do anything
        $acl->allow(1, null);
        
        // Guest can only display lists
        $acl->allow(4, 'casemanagers', array('list'));
        $acl->allow(4, 'clients', array('list'));
        $acl->allow(4, 'needsassessments', array('list'));
        $acl->allow(4, 'plans', array('list', 'findplandetails', 'findaplan'));
        $acl->allow(4, 'needsassessments', array('list','findaservice', 'findservicedetails'));
        $acl->allow(4, 'user', array('list','update','password','login','logout'));
        
        // Fetch the current user
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
            $roleId = $identity->roleId;
        }
        else {
            $roleId = 4;
        }
        $controller = $request->controller;
        $action = $request->action;
        
        if (! $acl->isAllowed($roleId, $controller, $action)){
            if ($roleId == '4'){
                $request->setControllerName('user');
                $request->setActionName('login');
            }
            else {
                $request->setControllerName('error');
                $request->setActionName('noauth');
            }
        }
    }
}

