<?php

class Application_Model_UserMapper
{
    protected $_dbUserTable;
    protected $_dbDetailTable;

    /* Set value for database table element */
    public function setDbUserTable($dbTable)
    {
        if (is_string($dbTable)) 
        {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this -> _dbUserTable = $dbTable;
        return $this;
    }

    /* Get element value from database USER table */
    public function getDbUserTable()
    {
        if (null === $this -> _dbUserTable) {
            $this -> setDbTable('Application_Model_DbTable_Users');
        }
        return $this -> _dbUserTable;
    }

    /* Set value for database table element */
    public function setDbDetailTable($dbTable)
    {
        if (is_string($dbTable)) 
        {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this -> _dbDetailTable = $dbTable;
        return $this;
    }

    /* Get element value from database USER table */
    public function getDbDetailTable()
    {
        if (null === $this -> _dbDetailTable) {
            $this -> setDbTable('Application_Model_DbTable_UserDetails');
        }
        return $this -> _dbDetailTable;
    }

    /* Create a new user */
    public function createUser(Application_Model_User $user, Application_Model_UserDetail $detail)
    {
        $userInfo = array('USERNAME' => $user -> getUserName(),
                          'PASSWORD' => $user -> getPassword(),
                          'EMAIL' => $user -> getEmail(),
                          'GENDER' => $user -> getGender(),
                          'REGISTER_TIME' => $user -> getRegisterTime());
        
        $userDetail = array('NICKNAME' => $detail -> getNickname(),
                            'FIRST_NAME' => $detail -> getFirstName(),
                            'LAST_NAME' => $detail -> getLastName(),
                            'PHONE_NUMBER' => $detail -> getPhoneNumber(),
                            'BIRTHDAY' => $detail -> getBirthday(),
                            'ADDRESS' => $detail -> getAddress(),
                            'BLOG_URL' => $detail -> getBlogUrl(),
                            'FACEBOOK' => $detail -> getFacebookUrl());
        
        $this -> getDbUserTable() -> insert($userInfo);
        $this -> getDbDetailTable() -> insert($userDetail);
    }

    /* Update the user's information */
    public function updateUser($id, Application_Model_UserDetail $info)
    {
        $info = array('NICKNAME' => $user -> getNickname(),
                      'FIRST_NAME' => $user -> getFirstName(),
                      'LAST_NAME' => $user -> getLastName(),
                      'PHONE_NUMBER' => $user -> getPhoneNumber(),
                      'BIRTHDAY' => $user -> getBirthday(),
                      'ADDRESS' => $user -> getAddress(),
                      'BLOG_URL' => $user -> getBlogUrl(),
                      'FACEBOOK' => $user -> getFacebookUrl());

        $this -> getDbDetailTable() -> update($info, array('INFO_ID = ?' => $id));
    }

    /* check whether the user name has already exist */
    public function checkExist($userName)
    {
        $select = $this -> getDbUserTable() -> select();
        $select -> where('USERNAME = ?', "$userName");
        $result = $this -> getDbUserTable() -> fetchAll($select);

        if (0 == count($result))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

}

