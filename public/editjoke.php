<?php 

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIRR__ . '/../includes/DatabaseFunctions.php';

try {
    if (isset($_POST['joketext'])) {
        updateJoke( $pdo, $_POST['jokeid'], $_POST['joketext'], 1);

        header('location: jokes.php');
    }else {

        $joke = getJoke( $pdo, $_GET['id']);
    }
}catch( PDOException $e ){

    $title = 'There is ERROR!';

    $output = 'ERROR on Database' . $e -> getMessage() . ', location: ' . 
    $e->getFile() . ': ' . $e -> getLine();
    
}