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

function insertJoke( $pdo, $fields ) {

    $query = 'INSERT INTO  `joke` (';

    foreach ( $fields as $key => $value) {
        $query .= '`' . $key . '`,';
    }

    $query = rtrim( $query, ',' );

    $query .= ') VALUES (';

    foreach ( $fields as $key => $value ) {
        $query .= ':' . $key . ',';
    }

    $query = rtrim( $query, ',' );

    $query .= ')';

    $fields = processDates($fields);

    query( $pdo, $query, $fields );
}

function updateJoke( $pdo, $fields ) {
    $query = ' UPDATE `joke` SET ';

    foreach ($fields as $key => $vaule) {
        $query .= '`' . $key . '` =:' . $key . ',';
    }

    $query = rtrim( $query, ',' );

    $query .= ' WHERE `id` = :primaryKey';
    
    $fields = processDates($fields);

    $fields['primaryKey'] = $fields['id'];

    query( $pdo, $query, $fields );

}

function deleteJoke( $pdo, $id ) {
    $parameters = [':id' => $id];

    query( $pdo, 'DELETE FROM `joke` WHERE `id` = :id', $parameters);
}

function allJokes( $pdo ){
    $jokes = query( $pdo, 'SELECT `joke`.`id`, `joketext`,`jokedate`, `name`, `email`
                            FROM `joke` INNER JOIN `author` ON `authorid` = `author`.`id`');

    return $jokes -> fetchAll();
}

function processDates( $fields ) {
    foreach( $fields as $key => $value ) {
        if( $value instanceof DateTime ) {
            $fields[$key] = $value -> format('Y-m-d H:i:s');
        }
    }

    return $fields;
}