<?php

namespace Ijdb\Controlls;

class login
{
    private $authentication;

    public function __construct(\FrameWork\Authentication $authentication)
    {
        $this -> authentication = $authentication;
    }

    public function error()
    {
        return ['template' => 'loginerror.html.php', 'title' => 'You are not logged in!'];
    }

    public function permissionerror()
    {
        return ['template' => 'loginerrorpermissions.html.php', 'title' => 'You do not have the authority.'];
    }

    public function loginForm()
    {
        return['template' => 'login.html.php', 'title' => 'Log In'];
    }

    public function processLogin()
    {
        if ($this-> authentication -> login($_POST['email'], $_POST['password'])) {
            header('location: /login/success');
        } else {
            return['template' => 'login.html.php',
            'title' => 'Log In',
            'variables' => [
                'error' => 'Invalid email or passworrd'
                 ]
            ];
        }
    }

    public function success()
    {
        return['template' => 'loginsuccess.html.php', 'title' => 'Log In Success!'];
    }

    public function logout()
    {
        \session_destroy();
        return ['template' => 'logout.html.php', 'title' => 'You are logged out now.'];
    }
}