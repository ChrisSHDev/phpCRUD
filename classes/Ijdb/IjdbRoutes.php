<?php 

namespace Ijdb;

class IjdbRoutes implements \FrameWork\Routes
{
    private $authorsTable;
    private $jokesTable;
    private $authentication;

    public function __construct(){
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this -> jokesTable = new \FrameWork\DatabaseTable( $pdo, 'joke', 'id' );
        $this -> authorsTable = new \FrameWork\DatabaseTable( $pdo, 'author', 'id' );
        $this -> authentication = new \FrameWork\Authentication( $this -> authorsTable, 'email', 'password');
    }

    public function getRoutes(): array
    {

        $authorController = new \Ijdb\Controllers\Register( $this -> authorsTable );
        $jokeController = new \Ijdb\Controllers\Joke($this -> jokesTable, $this -> authorsTable);
        $loginController = new \Ijdb\Controllers\Login($this->authentication);
        
        $routes = [
            'author/register' => [
                'GET' => [
                    'controller' => $authorController,
                    'action' => 'registrationForm'
                ],
                'POST' => [
                    'controller' => $authorController,
                    'action' => 'registerUser'
                ]
                ],
            'login/error' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'error'
                ]
                ],
            'login' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'loginForm'
                ],
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'processLogin'
                ]
                ],
            'author/success' => [
                'GET' => [
                    'controller' => $authorController,
                    'action' => 'success'
                ]
            ],
            'joke/edit' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'saveEdit'
                ],
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'edit'
                ],
                'login' => true
                ],
                'joke/delete' => [
                    'POST' => [
                        'controller' => $jokeController,
                        'action' => 'delete'
                    ],
                    'login' => true
                ],
                'joke/list' => [
                    'GET' =>[
                        'controller' => $jokeController,
                        'action' => 'list'
                    ]
                    ],
                ''=>[
                    'GET' => [
                        'controller' => $jokeController,
                        'action' => 'home'
                    ]
                ]

            ];


        return $routes;
    }

    public function getAuthentication(): \FrameWork\Authentication
    {
        return $this -> authentication;
    }
}