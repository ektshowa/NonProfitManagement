<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
       protected function _initView() {
		// Initialize view
		$view = new Zend_View();
		$view->doctype('HTML5');
		$view->headTitle('Manage Non Profit');
		$view->env = APPLICATION_ENV;
		//$view->baseUrl = Zend_Registry::get('config')->root_path;
		$view->skin = 'blues';
                $view->publicPath = PUBLIC_PATH;
                
		$view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
		$view->jQuery()->setUiLocalPath('/js/jquery-ui-1.11.2/jquery-ui.min.js');
                $view->jQuery()->setLocalPath('/js/jquery/js/jquery-1.11.2.min.js');
                $view->jQuery()->enable();
                $view->jQuery()->uiEnable();
		
		//Add it to the renderer
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
		
		$viewRenderer->setView($view);
		//Return it so that it can stored by the Bootstrap
		return  $view;
	}
        
        protected function _initAutoload(){
            // Add autoloader empty namespace
            $autoloader = Zend_Loader_Autoloader::getInstance();
            $autoloader->registerNamespace('ManageNonProfit_');
            
        }
        
        protected function _getPublicPath() {
            return realpath(APPLICATION_PATH . '/../public/');
        }

       
}

