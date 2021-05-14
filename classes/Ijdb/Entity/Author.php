<?php

namespace Ijdb\Entity;

class Author
{
    public $id;
    public $name;
    public $email;
    public $password;
    private $jokesTable;

    public function __construct(\Hanbit\DatabaseTable $jokesTable)
    {
        $This -> jokesTable = $jokesTable;
    }

    public function getJokes()
    {
        return $this -> jokesTable -> find('authorId', $this -> id);
    }

    public function addJoke($joke)
    {
        $joke['authorId'] = $this -> id;
        $this -> jokesTable -> save($joke);
    }
}