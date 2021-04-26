<?php 
namespace Ijdb\Controllers;
use \FrameWork\DatabaseTable;

class Register
{
    private $authorsTable;

    public function __construct( DatabaseTable $authorsTable )
    {
        $this -> authorsTable = $authorsTable;
    }

    public function registrationForm()
    {
        return ['template' => 'register.html.php', 
        'title' => 'Register User'];
    }

    public function success()
    {
        return ['template' => 'registersuccess.html.php', 'title' => 'Your account is registered!'];
    }

    public function registerUser() {
        $author = $_POST['author'];

        $valid = true;

        $errors = [];



        if(empty($author['name'])){
            $valid = false;
            $errors[] = 'A name is a required field';
        }

        if(empty($author['email'])){
            $valid = false;
            $errors[] = 'An email is a required field';
        }elseif( filter_var($author['email'], FILTER_VALIDATE_EMAIL) == false ){
            $valid = false;
            $errors[] = 'It\' unvalide email address';
        }else{
            $author['email'] = strtolower($author['email']);
        }

        if(count( $this-> authorsTable -> find('email', $author['email']))>0 ){
            $valid = false;
            $errors[] = 'You already have an account';
        }

        if(empty($author['password'])){
            $valid = false;
            $errors[] = 'A password is a required field';
        }

        if( $valid == true) {
            $author['password'] = \password_hash( $author['password'], PASSWORD_DEFAULT);

            $this -> authorsTable -> save($author);

            header('Location: /author/success');
        }

        if( $valid == true ){
            $this -> authorsTAble -> save( $author );

            header('Location: /author/success');
        }
        else{
            return['template' => 'register.html.php', 'title' => 'Register User',
            'variables' => [
                'errors' => $errors,
                'author' => $author
                ]
            ];
        }
    }
}