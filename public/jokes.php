<?php 

try {

    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../includes/DatabaseFunctions.php';

    $jokes = allJokes( $pdo );

    $title = 'Joke Board';

    $totalJokes = totalJokes( $pdo );

    ob_start();

    include __DIR__ . '/../templates/jokes.html.php';

    $output = ob_get_clean();


}catch ( PDOException $e) {

    $output = 'Database Connection Fail!' . 
    $e -> getMessage() . ', location: ' .
    $e -> getFile() . ':' . $e -> getLine();

}

include __DIR__ . '/../templates/layout.html.php';