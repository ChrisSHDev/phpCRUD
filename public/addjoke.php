<?php 

if( isset( $_POST['joketext'])) {

    try {
        
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../includes/DatabaseFunctions.php';

        insert( $pdo, 'joke', 
                ['authorId' => 1, 
                 'jokeText' => $_POST['joketext'],
                 'jokedate' => new DateTime()
        ]);

        header('location: jokes.php');

    } catch (PDOException $e) {

        $title = 'There is ERROR!';

        $output = 'ERROR on Database' . $e -> getMessage() . ', location: ' . 
        $e->getFile() . ': ' . $e -> getLine();

    }

}else {

    $title = 'Add Joke Article';

    ob_start();

    include __DIR__ . '/../templates/addjoke.html.php';

    $output = ob_get_clean();

}

include __DIR__ . '/../templates/layout.html.php';