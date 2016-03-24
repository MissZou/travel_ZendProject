<?php

class Application_Form_Login extends Zend_Form
{
    public function __construct($options = null) 
    { 
        parent::__construct($options);
        $this -> setName('login');

        $this -> setMethod('post');
        
        // Add an user name element
        $userName = new Zend_Form_Element_Text('userName');
        $userName -> setLabel('Login ID')
                  -> setRequired(true)
                  -> addValidator('NotEmpty')
                  -> addFilters(array('StringTrim'));

        // Add a password element
        $password = new Zend_Form_Element_Password('password');
        $password -> setLabel('Password')
                  -> setRequired(true)
                  -> addValidator('NotEmpty');

        /* Add a CAPTCHA element to verify the user is a human, not a machine. */
        $captcha = new Zend_Form_Element_Captcha('captcha', 
                      array('label' => "Please verify you're a human",
                            'captcha' => 'Figlet',
                            'captchaOptions' => array('captcha' => 'Figlet',
                                                      'wordLen' => 4,
                                                      'timeout' => 300,)));
        
        // Add a submit button
        $submit = new Zend_Form_Element_Submit('submit');
        $submit -> setLabel('Log in');
        
        $this -> addElements(array($userName, $password, $captcha, $submit));
    }
}

