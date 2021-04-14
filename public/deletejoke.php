<?php 

    try {
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../includes/DatabaseFunctions.php';

        delete($pdo,'joke' ,'id' ,$_POST['id']);

        header('location: jokes.php');


    } catch (PDOException $e) {

        $title = 'There is ERROR!';

        $output = 'ERROR on Database' . $e -> getMessage() . ', location: ' . 
        $e->getFile() . ': ' . $e -> getLine();

    }


include __DIR__ . '/../templates/layout.html.php';