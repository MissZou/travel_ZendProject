<?php

class AuthenticationController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->_redirect('/user/login');
    }

    // Log in
    public function loginAction()
    {
        $db = Zend_Db_Table::getDefaultAdapter();

        // Generate a login form
        $loginForm = new Application_Form_Login();
 
        $auth = Zend_Auth::getInstance();
        if ($loginForm -> isValid($_POST))
        {
            $adapter = new Zend_Auth_Adapter_DbTable($db, 'USER', 'USERNAME', 'PASSWORD');
            $adapter -> setIdentity($loginForm -> getValue('userName'));
            $adapter -> setCredential($loginForm -> getValue('password'));
            $result = $auth -> authenticate($adapter);
 
            if ($result -> isValid()) {
                $session = new Zend_Session_Namespace('users');
                $session -> userName = $loginForm -> getValue('userName');

                /* If sucessfully log in, the member would be directed to edit view. */
                $this -> _helper -> FlashMessenger('Log in success!');
                $this -> _redirect('');
            }
            else
            {
                /* If log in failed, the guest would be directed to register view. */
                $this -> view -> loginMessage = "Log in failed. Invalid username or pasword!";
                $this -> _redirect('');
            }
 
        }

        $this -> view -> loginForm = $loginForm;
    }

    // Log out
    public function logoutAction()
    {
        /* clear the user's session */
        $session = new Zend_Session_Namespace('users');
        $session -> __unset("users");
        $this -> _redirect('/index/index');
    }

    // Register a new user
    public function registerAction()
    {
        /* Generate a register form */
        $registerForm = new Application_Form_UserInfo();
        $request = $this -> getRequest();
        
        if ($request -> isPost()) 
        {
            if ($registerForm -> isValid($request -> getPost())) 
            {
                $member = new Application_Model_Member($registerForm -> getValues());
                $mapper = new Application_Model_MemberMapper();

                /* Check whether the user name had been registered. */
                if (true == $mapper -> checkExist($registerForm -> getValue('userName')))
                {
                    echo "The user name has already been registerd. Please choose another one.";
                }
                else
                {
                    /* Check whether the password equals to the confirm password. */
                    if ($registerForm -> getValue('password') != $registerForm -> getValue('passwordConfirm'))
                    {
                        echo "The password do not match confirm password! Please input again!";
                    }
                    else
                    {
                        $mapper -> createUser($member);
                        /* After successfully registered, the member would be directed to books view page. */
                        $this -> _helper -> FlashMessenger('Register success!');
                        $this -> _redirect('books/view');
                    }

                }              
            }
        }

        $this -> view -> registerForm = $registerForm;
    }

    // Edit personal information
    public function editAction()
    {
        $editForm = new Application_Form_Member();

        /* Reuse member form, use a 'edit' button to replace the 'register' button */
        $editForm -> removeElement('submit');
        $submit = new Zend_form_Element_Submit('submit');
        $submit -> setLabel('Edit');
        $editForm -> addElement($submit);

        $request = $this->getRequest();

        /* Get user name from Zend session */
        $session = new Zend_Session_Namespace('users');
        if(isset($session -> userName))
        {
            $userName = $session -> userName;
        }
        else
        {
            echo "Please log in first!";
        }

        $mapper = new Application_Model_MemberMapper();
        $data = $mapper -> find($userName);

        /* Set default value for edit form */
        $editForm -> userName -> setValue($data[0] -> getUserName());
        $editForm -> firstName -> setValue($data[0] -> getFirstName());
        $editForm -> lastName -> setValue($data[0] -> getLastName());
        $editForm -> email -> setValue($data[0] -> getEmail());
        $editForm -> phoneNumber -> setValue($data[0] -> getPhoneNumber());
        $editForm -> birthday -> setValue($data[0] -> getBirthday());
        $editForm -> address -> setValue($data[0] -> getAddress());

        if ($request -> isPost()) 
        {
            if ($editForm -> isValid($request -> getPost()))
            {
                $member = new Application_Model_Member($editForm -> getValues());
                $mapper = new Application_Model_MemberMapper();

                /* Check whether the user name had been registered. */
                if ((true == $mapper -> checkExist($editForm -> getValue('userName')))
                    && ($editForm -> getValue('userName') != $userName))
                {
                    echo "The user name has already been registerd. Please choose another one.";
                }
                else
                {
                    /* Check whether the password equals to the confirm password. */
                    if ($editForm -> getValue('password') != $editForm -> getValue('passwordConfirm'))
                    {
                        echo "The password do not match confirm password! Please input again!";
                    }
                    else
                    {
                        $id = $data[0] -> getId();
                        $mapper -> updateUser($id, $member);
                        /* When editing finish, the member would be directed to books view page. */
                        $this -> _redirect('books/view');
                    }
                }
            }
        }   

        $this -> view -> editForm = $editForm;
    }
}

