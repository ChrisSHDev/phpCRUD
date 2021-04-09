<?php 

if( isset( $_POST['joketext'])) {

    try {
        
        include __DIR__ . '/../includes/DatabaseConnection.php';

        $sql = 'INSERT INTO `joke` SET
        `joketext` = :joketext,
        `jokedate` = CURDATE()';

        $stmt = $pdo -> prepare($sql);

        $stmt -> bindValue(':joketext', $_POST['joketext']);

        $stmt -> execute();

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