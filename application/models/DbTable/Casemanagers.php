<?php

class Application_Model_DbTable_Casemanagers extends Zend_Db_Table_Abstract {

    protected $_name = 'casemanagers';
    protected $_dependentTables = array('followup');

    protected $_referenceMap = array(
    	'User' => array(
    		'columns'	=> array('userID'),
    		'refTableClass'	=> 'Users',
    		'refColumns'	=> array('id')
    	),
    	
    );
}
?>
