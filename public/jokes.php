<?php 

try {

    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../includes/DatabaseFunctions.php';

    $sql = 'SELECT `joke`.`id`, `joketext`, `name`, `email` 
    FROM `joke` INNER JOIN `author` ON `authorid` = `author`.`id`';

    $jokes = $pdo -> query($sql);

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