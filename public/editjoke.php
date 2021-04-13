<?php 

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try {

    if (isset($_POST['joketext'])) {
        updateJoke( $pdo, [
            'id' => $_POST['jokeid'],
            'joketext' => $_POST['joketext'],
            'authorId' => 1,
            'jokedate' => new DateTime()
        ]);

        header('location: jokes.php');
    }else {

        $joke = getJoke( $pdo, $_GET['id']);

        $title = 'Edit a Joke Article';

        ob_start();

        include __DIR__ . '/../templates/editjoke.html.php';

        $output = ob_get_clean();

    }

}catch( PDOException $e ){

    $title = 'There is ERROR!';

    $output = 'ERROR on Database' . $e -> getMessage() . ', location: ' . 
    $e->getFile() . ': ' . $e -> getLine();
    
}

include __DIR__ . '/../templates/layout.html.php';