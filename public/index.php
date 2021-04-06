<?php 

try {

    $pdo = new PDO( 'mysql:host=localhost;dbname=ijdb;charset=utf8',
    'ijdbuser', 'mypassword');

    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'CREATE TABLE joke (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        joketext TEXT,
        jokedate DATE NOT NULL
    ) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB';

    $pdo->exec($sql);

    $output = 'joke tabe is created!';

}catch ( PDOException $e) {

    $output = 'Database Connection Fail!' . 
    $e -> getMessage() . ', location: ' .
    $e->getFile() . ':' . $e->getLine();

}

include __DIR__ . '/../templates/output.html.php';