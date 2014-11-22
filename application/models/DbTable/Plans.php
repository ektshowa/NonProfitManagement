<?php

class Application_Model_DbTable_Plans extends Zend_Db_Table_Abstract
{

    protected $_name = 'plans';
    protected $_dependentTables = array('services','followup'); 


}

