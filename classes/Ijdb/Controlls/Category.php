<?php
namespace Ijdb\Controllers;

class Category
{
    private $categoriesTable;

    public function __construct(\FrameWork\DatabaseTable $categoriesTable)
    {
        $this -> categoriesTable = $categoriesTable;
    }
}