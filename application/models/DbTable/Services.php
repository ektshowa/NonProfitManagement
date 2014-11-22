<?php

class Application_Model_DbTable_Services extends Zend_Db_Table_Abstract
{

    protected $_name = 'services';
    protected $_dependentTables = array('needsassessments', 'followup');

	protected $_referenceMap = array(
    	'Plan' => array(
    		'columns'		=> array('planId'),
    		'refTableClass'	=> 'Plans',
    		'refColumns'	=> array('id')
    	)
    );
}

