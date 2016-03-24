<?php

class Application_Model_User
{
    protected $_id;
	protected $_userName;
	protected $_password;
	protected $_email;
	protected $_gender;
    protected $_registerTime;

	public function __construct(array $options = null)
    {
        if (is_array($options)) 
        {
            $this -> setOptions($options);
        }
    }

    public function __set($userName, $value)
    {
        $method = 'set' . $userName;
        if (('mapper' == $userName) || !method_exists($this, $method)) 
        {
            throw new Exception('Invalid user property');
        }
        $this -> $method($value);
    }

    public function __get($userName)
    {
        $method = 'get' . $userName;
        if (('mapper' == $userName) || !method_exists($this, $method)) 
        {
            throw new Exception('Invalid user property');
        }
        return $this -> $method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) 
        {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) 
            {
                $this -> $method($value);
            }
        }
        return $this;
    }

    // Set & Get user id
    public function setId($id)
    {
        $this -> _id = (int)$id;
        return $this;
    }

    public function getId()
    {
        return $this -> _id;
    }

    // Set & Get user name
    public function setUserName($userName)
    {
        $this -> _userName = $userName;
        return $this;
    }
    public function getUserName()
    {
        return $this -> _userName;
    }

    // Set & Get password
    public function setPassword($password)
    {
        $this -> _password = $password;
        return $this;
    }
    public function getPassword()
    {
        return $this -> _password;
    }
    
    // Set & Get email
    public function setEmail($email)
    {
        $this -> _email = $email;
        return $this;
    }
    public function getEmail()
    {
        return $this -> _email;
    }
    
    // Set & Get gender
    public function setGender($gender)
    {
        $this -> _gender = $gender;
        return $this;
    }
    public function getGender()
    {
        return $this -> _gender;
    }

    // Set & Get register time
    public function setRegisterTime($registerTime)
    {
        $this -> _registerTime = $registerTime;
        return $this;
    }
    public function getRegisterTime()
    {
        return $this -> _registerTime;
    }
}

