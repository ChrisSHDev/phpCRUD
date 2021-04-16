<?php 

    try{
        include __DIR__ . '/../classes/EntryPoint.php';

        $route = ltrim( strtok( $_SERVER[ 'REQUEST_URI' ], '?'), '/' );

        $entryPoint = new EntryPoint($route);

        $entryPoint -> run();

    }catch (PDOException $e) {
        $title = 'There is ERROR!';

        $output = 'ERROR on Database' . $e -> getMessage() . ', location: ' . 
        $e->getFile() . ': ' . $e -> getLine();

        include __DIR__ . '/../templates/layout.html.php';
    }

    
