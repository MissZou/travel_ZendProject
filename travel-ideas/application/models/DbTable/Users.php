<?php
require_once 'Zend/Db/Table/Abstract.php';
class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract
{
    protected $_name = 'USER';
}