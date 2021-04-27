<?php

    try {
        include __DIR__ . '/../includes/autoload.php';

        $route = ltrim(strtok($_SERVER[ 'REQUEST_URI' ], '?'), '/');

        $entryPoint = new FrameWork\EntryPoint($route, $_SERVER['REQUEST_METHOD'], new Ijdb\IjdbRoutes());
        var_dump($route);
        $entryPoint -> run();
    } catch (PDOException $e) {
        $title = 'There is ERROR!';

        $output = 'ERROR on Database' . $e -> getMessage() . ', location: ' .
        $e->getFile() . ': ' . $e -> getLine();

        include __DIR__ . '/../templates/layout.html.php';
    }