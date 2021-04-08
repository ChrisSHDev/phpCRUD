<?php 

try {

    $pdo = new PDO( 'mysql:host=localhost;dbname=ijdb;charset=utf8',
    'ijdbuser', 'mypassword');

    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT `id`, `joketext` FROM `joke`';
    $jokes = $pdo -> query($sql);

    $title = 'Joke Board';

    ob_start();

    include __DIR__ . '/../templates/jokes.html.php';

    $output = ob_get_clean();


}catch ( PDOException $e) {

    $output = 'Database Connection Fail!' . 
    $e -> getMessage() . ', location: ' .
    $e -> getFile() . ':' . $e -> getLine();

}

include __DIR__ . '/../templates/layout.html.php';