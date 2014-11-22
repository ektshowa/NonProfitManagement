<?php

class BugController extends Zend_Controller_Action
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
        // action body
    }

    public function submitAction()
    {
        $frmBugReport = new Application_Form_BugReportForm();
        $frmBugReport->setAction('/bug/submit');
        $frmBugReport->setMethod('post');
        if ($this->getRequest()->isPost()){
        	if ($frmBugReport->isValid($_POST)){
        		$data = $frmBugReport->getValues();
        	}
        }
        $this->view->form = $frmBugReport;
    }


}







