<?php

namespace Ijdb;

class IjdbRoutes implements \FrameWork\Routes
{
    private $authorsTable;
    private $jokesTable;
    private $authentication;

    public function __construct()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this -> jokesTable = new \FrameWork\DatabaseTable($pdo, 'joke', 'id');
        $this -> authorsTable = new \FrameWork\DatabaseTable($pdo, 'author', 'id');
        $this -> authentication = new \FrameWork\Authentication($this -> authorsTable, 'email', 'password');
    }

    public function getRoutes(): array
    {
        $jokeController = new \Ijdb\Controlls\Joke($this -> jokesTable, $this -> authorsTable, $this -> authentication);
        $loginController = new \Ijdb\Controlls\Login($this->authentication);
        $authorController = new \Ijdb\Controlls\Register($this -> authorsTable);
        
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
            'login/success' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'success'
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
            'logout'=> [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'logout'
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
                '/joke/list' => [
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