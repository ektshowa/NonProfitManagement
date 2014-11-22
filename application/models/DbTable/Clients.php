<?php

class Application_Model_DbTable_Clients extends Zend_Db_Table_Abstract
{

    protected $_name = 'clients';
    
    protected $_dependentTables = array('Needsassessments', 'Followup');
    
}

