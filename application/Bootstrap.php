<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initView() {
		// Initialize view
		$view = new Zend_View();
		$view->doctype('XHTML1_STRICT');
		$view->headTitle('Manage Non Profit');
		$view->env = APPLICATION_ENV;
		//$view->baseUrl = Zend_Registry::get('config')->root_path;
		$view->skin = 'blues';
		
		$view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
		$view->jQuery()->addStylesheet($view->baseUrl . '/js/jquery/css/ui-lightness/jquery-ui-1.8.19.custom.css');
                $view->jQuery()->setLocalPath($view->baseUrl . '/js/jquery/js/jquery-1.7.2.min.js');
                $view->jQuery()->setUiLocalPath($view->baseUrl .'/js/jquery/js/jquery-ui-1.8.19.custom.min.js');
                $view->jQuery()->enable();
                $view->jQuery()->uiEnable();
		
		
		//Add it to the renderer
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
		
		$viewRenderer->setView($view);
		//Return it so that it can stored by the Bootstrap
		return  $view;
	}

}

