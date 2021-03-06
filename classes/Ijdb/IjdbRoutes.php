<?php

namespace Ijdb;

class IjdbRoutes implements \FrameWork\Routes
{
    private $authorsTable;
    private $jokesTable;
    private $authentication;
    private $categoriesTable;
    private $jokeCategoriesTable;

    public function __construct()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this -> jokesTable = new \FrameWork\DatabaseTable($pdo, 'joke', 'id', '\Ijdb\Entity\Joke', [ &$this -> authorsTable, &$this -> jokeCategoriesTable]);
        $this -> authorsTable = new \FrameWork\DatabaseTable($pdo, 'author', 'id', '\Ijdb\Entity\Author', [ &$this -> jokesTable]);
        $this -> categoriesTable = new \FrameWork\DatabaseTable($pdo, 'category', 'id', '\Ijdb\Entity\Category', [&$this -> jokesTable, &$this -> jokeCategoriesTable]);
        $this -> jokeCategoriesTable = new \FrameWork\DatabaseTable($pdo, 'joke_category', 'categoryId');
        $this -> authentication = new \FrameWork\Authentication($this -> authorsTable, 'email', 'password');
    }

    public function getRoutes(): array
    {
        $jokeController = new \Ijdb\Controlls\Joke($this -> jokesTable, $this -> authorsTable, $this -> categoriesTable, $this -> authentication);
        $loginController = new \Ijdb\Controlls\Login($this->authentication);
        $authorController = new \Ijdb\Controlls\Register($this -> authorsTable);
        $categoryController = new \Ijdb\Controlls\Category($this -> categoriesTable);
        
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
              'login/permissionerror' => [
                'GET' => [
                  'controller' => $loginController,
                  'action' => 'permissionerror'
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
                    ],
                'category/edit' => [
                  'POST' => [
                    'controller' => $categoryController,
                    'action' => 'saveEdit'
                  ],
                  'GET' => [
                    'controller' => $categoryController,
                    'action' => 'edit'
                  ],
                  'login' => true,
                  'permissions' => \Ijdb\Entity\Author::EDIT_CATEGORIES
                ],
                'category/list' => [
                  'GET' => [
                    'controller' => $categoryController,
                    'action' => 'list'
                  ],
                  'login' => true,
                  'permission' => \Ijdb\Entity\Author::LIST_CATEGORIES
                ],
                'category/delete' => [
                  'POST' => [
                    'controller' => $categoryController,
                    'action' => 'delete'
                  ],
                  'login' => true,
                  'permissions' => \Ijdb\Entity\Author::REMOVE_CATEGORIES
                ],
                'author/permissions' => [
                  'GET' => [
                    'controller' => $authorController,
                    'action' => 'permissions'
                  ],
                  'POST' => [
                    'controller' => $authorController,
                    'action' => 'savePermissions'
                  ],
                  'login' => true,
                  'permissions' => \Ijdb\Entity\Author::EDIT_USER_ACCESS
                ],
                'author/list' => [
                  'GET' => [
                    'controller' => $authorController,
                    'action' => 'list'
                  ],
                  'login' => true,
                  'permissions' => \Ijdb\Entity\Author::EDIT_USER_ACCESS

            ]
          ];

        return $routes;
    }

    public function getAuthentication(): \FrameWork\Authentication
    {
        return $this -> authentication;
    }

    public function checkPermission($permission): bool
    {
        $user = $this -> authentication -> getUser();

        if ($user && $user -> hasPermission($permission)) {
            return true;
        } else {
            return false;
        }
    }
}