<?php

class Application_Model_UserDetail
{
    protected $_id;
	protected $_nickname;
    protected $_firstName;
    protected $_lastName;
    protected $_phoneNumber;
	protected $_birthday;
    protected $_address;
    protected $_blogUrl;
    protected $_facebookUrl;

	public function __construct(array $options = null)
    {
        if (is_array($options)) 
        {
            $this -> setOptions($options);
        }
    }

    public function __set($nickname, $value)
    {
        $method = 'set' . $nickname;
        if (('mapper' == $nickname) || !method_exists($this, $method)) 
        {
            throw new Exception('Invalid member property');
        }
        $this -> $method($value);
    }

    public function __get($nickname)
    {
        $method = 'get' . $nickname;
        if (('mapper' == $nickname) || !method_exists($this, $method)) 
        {
            throw new Exception('Invalid member property');
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

    // Set & Get nickname
    public function setNickname($nickname)
    {
        $this -> _nickname = $nickname;
        return $this;
    }
    public function getNickname()
    {
        return $this -> _nickname;
    }

    // Set & Get first name
    public function setFirstName($firstName)
    {
        $this -> _firstName = $firstName;
        return $this;
    }
    public function getFirstName()
    {
        return $this -> _firstName;
    }

    // Set & Get last name
    public function setLastName($lastName)
    {
        $this -> _lastName = $lastName;
        return $this;
    }
    public function getLastName()
    {
        return $this -> _lastName;
    }

    // Set & Get phone number
    public function setPhoneNumber($phoneNumber)
    {
        $this -> _phoneNumber = $phoneNumber;
        return $this;
    }
    public function getPhoneNumber()
    {
        return $this -> _phoneNumber;
    }

    // Set & Get birthday
    public function setBirthday($birthday)
    {
        $this -> _birthday = $birthday;
        return $this;
    }
    public function getBirthday()
    {
        return $this -> _birthday;
    }

    // Set & Get address
    public function setAddress($address)
    {
        $this -> _address = $address;
        return $this;
    }
    public function getAddress()
    {
        return $this -> _address;
    }

    // Set & Get blog url
    public function setBlogUrl($blogUrl)
    {
        $this -> _blogUrl = $blogUrl;
        return $this;
    }
    public function getBlogUrl()
    {
        return $this -> _blogUrl;
    }

    // Set & Get facebook url
    public function setFacebookUrl($facebookUrl)
    {
        $this -> _facebookUrl = $facebookUrl;
        return $this;
    }
    public function getFacebookUrl()
    {
        return $this -> _facebookUrl;
    }

}

