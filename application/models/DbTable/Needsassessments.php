<?php

class Application_Model_DbTable_Needsassessments extends Zend_Db_Table_Abstract
{

    protected $_name = 'needsassessments';
    
    protected $_referenceMap = array(
    	'Client' => array(
    		'columns'		=> array('clientId'),
    		'refTableClass'	=> 'Clients',
    		'refColumns'	=> array('id')
    	),
    	'Service' => array(
    		'columns'		=> array('serviceId'),
    		'refTableClass' => 'Services',
    		'refColumns'	=> array('id')
    	
    	)
    );


}

