<?php 


function query( $pdo, $sql, $parameters = [] ) {

    $query = $pdo -> prepare( $sql );

    foreach ( $parameters as $name => $value) {

        $query -> bindValue( $name, $value );

    }

    $query -> execute();

    return $query;

}

function totalJokes( $database ) {

    $query = query( $database, 'SELECT COUNT(*) FROM `joke`');

    $row = $query -> fetch();

    return $row[0];

}

function getJoke( $pdo, $id ) {

    $parameters = [ ':id' => $id ];

    $query = query( $pdo, 'SELECT * FROM `joke`
    WHERE `id` = :id', $parameters);

    return $query->fetch();

}

function insertJoke( $pdo, $joketext, $authrId ) {

    $query = 'INSERT INTO `joke` (`joketext`, `jokedate`, `authorId`)
                VALUES (:joketext, CURDATE(), :authorId)';
    
    $parameters = [':joketext' => $joketext, ':authorId' => $authorId];

    query( $pdo, $query, $parameters);
    
}