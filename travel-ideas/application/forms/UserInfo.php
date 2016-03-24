<?php

class Application_Form_UserInfo extends Zend_Form
{
   public function __construct($options = null) 
    { 
        parent::__construct($options);
        $this -> setName('userInfo');

        $this -> setMethod('post');
        
        // Add an user name element
        $userName = new Zend_Form_Element_Text('userName');
        $userName -> setLabel('Login ID')
                  -> setRequired(true)
                  -> addValidator('NotEmpty')
                  -> addFilters(array('StringTrim'))
                  -> addValidator('alnum')
                  -> addValidator('StringLength', false, array(5, 20));

        // Add a password element
        $password = new Zend_Form_Element_Password('password');
        $password -> setLabel('Password')
        		      -> setRequired(true)
        		      -> addValidator('NotEmpty')
                  -> addFilters(array('StringTrim'))
                  -> addValidator('StringLength', false, array(5, 20));

        // Add a confirm password element
        $passwordConfirm = new Zend_Form_Element_Password('passwordConfirm');
        $passwordConfirm -> setLabel('Confirm Password')
                         -> setRequired(true)
                         -> addValidator('NotEmpty')
                         -> addFilters(array('StringTrim'))
                         -> addValidator('StringLength', false, array(5, 20));
        
        // Add an email element
        $email = new Zend_Form_Element_Text('email');
        $email -> setLabel('Email')
               -> setRequired(true)
               -> addValidator('NotEmpty')
               -> addValidator('EmailAddress');

        // Add a gender element
        $gender = new Zend_Form_Element_Slect('gender'); 
        $gender -> setLabel('Gender')
                -> setRequired(true)
                -> addMultiOption('male', 'Male')
                -> addMultiOption('female', 'Female')
                -> addValidator('NotEmpty'); 
        
        // Add a nickname element
        $nickname = new Zend_Form_Element_Text('nickname');
        $nickname -> setLabel('Nickname')
                  -> setRequired(true)
                  -> addValidator('NotEmpty')
                  -> addValidator('StringLength', false, array(3, 15));
        
        // Add a first name element
      	$firstName = new Zend_Form_Element_Text('firstName');
      	$firstName -> setLabel('First Name')
                   -> addValidator('StringLength', false, array(3, 15));

        // Add a last name element
     	  $lastName = new Zend_Form_Element_Text('lastName');
      	$lastName -> setLabel('Last Name')
                  -> addValidator('StringLength', false, array(3, 15));

        // Add a phone number element
        $phoneNumber = new Zend_Form_Element_Text('phoneNumber');
        $phoneNumber -> setlabel('Phone Number')
                     -> addValidator('digits');

        // Add a birthday element
      	$birthday = new Zend_Form_Element_Text('birthday');
      	$birthday -> setLabel('Birthday');

        // Add an address element
        $address = new Zend_Form_Element_Text('address');
        $address -> setLabel('Address')
                 -> addValidator('alnum');

        // Add an blog url element
        $blogUrl = new Zend_Form_Element_Text('blogUrl');
        $blogUrl -> setLabel('BLOG');
        
        // Add an facebook url element
        $facebookUrl = new Zend_Form_Element_Text('facebookUrl');
        $facebookUrl -> setLabel('FACEBOOK');
        
        // Add a submit button
      	$submit = new Zend_form_Element_Submit('submit');
      	$submit -> setLabel('Register');

      	$this -> addElements(array($userName, $password, $passwordConfirm, $email, $gender, 
                                   $nickname, $firstName, $lastName, $phoneNumber, $birthday, 
                                   $address, $blogUrl, $facebookUrl, $submit));
    }
}

