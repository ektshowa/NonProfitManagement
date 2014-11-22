<?php

class Application_Model_DbTable_Followup extends Zend_Db_Table_Abstract
{

    protected $_name = 'followup';
    protected $_referenceMap = array(
    	'Client' => array(
    		'columns'		=> array('clientId'),
    		'refTableClass'	=> 'Clients',
    		'refColumns'	=> array('id')
    	),
    	'Plan' => array(
    		'columns'		=> array('planId'),
    		'refTableClass' => 'Plans',
    		'refColumns'	=> array('id')
    	
    	),
    	'Casemanager' => array(
    		'columns'		=> array('caseManagerId'),
    		'refTableClass' => 'Casemanagers',
    		'refColumns'	=> array('id')
    	)
    );
    
}

