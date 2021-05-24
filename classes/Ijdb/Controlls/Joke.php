<?php

namespace Ijdb\Controlls;

use \FrameWork\DatabaseTable;
use \FrameWork\Authentication;

class Joke
{
    private $authorsTable;
    private $jokesTable;
    private $categoriesTable;
    private $authentication;

    public function __construct(DatabaseTable $jokesTable, DatabaseTable $authorsTable, DatabaseTable $categoriesTable, Authentication $authentication)
    {
        $this -> jokesTable = $jokesTable;
        $this -> authorsTable = $authorsTable;
        $this -> categoriesTable = $categoriesTable;
        $this -> authentication = $authentication;
    }

    public function list()
    {
        $jokes = $this -> jokesTable -> findAll();

        $title = 'Joke Board';

        $totalJokes = $this -> jokesTable -> total();

        $author = $this -> authentication -> getUser();

        return ['template' => 'jokes.html.php',
                     'title' => $title,
                     'variables' => [
                        'totalJokes' => $totalJokes,
                        'jokes' => $jokes,
                        'userId' => $author -> id ?? null
                     ]
                    ];
    }

    public function home()
    {
        $title = 'Online Joke World';

        return [ 'template' => 'home.html.php', 'title' => $title ];
    }

    public function delete()
    {
        $author = $this -> authentication -> getUser();

        $joke = $this -> jokesTable -> findById($_POST['id']);
        if ($joke -> authorid != $author-> id) {
            return;
        }

        $this -> jokesTable -> delete($_POST['id']);

        header('location: /joke/list');
    }

    public function saveEdit()
    {
        $author = $this -> authentication -> getUser();

        $joke = $_POST['joke'];
        $joke['jokedate'] = new \DateTime();

        $jokeEntity = $author->addJoke($joke);


        foreach ($_POST['category'] as $categoryId) {
            $jokeEntity -> addCategory($categoryId);
        }

        header('location: /joke/list');
    }


    public function edit()
    {
        $author = $this -> authentication -> getUser();
        $categories = $this -> categoriesTable -> findAll();

        if (isset($_GET['id'])) {
            $joke = $this -> jokesTable -> findById($_GET['id']);
        }

        $title = 'Edit Joke Article';

        return ['template' => 'editjoke.html.php',
                    'title' => $title,
                    'variables' => [
                        'joke' => $joke ?? null,
                        'userId' => $author -> id ?? null,
                        'categories' => $categories
                    ]
                    
                ];
    }
}