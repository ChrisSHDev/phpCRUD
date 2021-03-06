<?php 

try {

    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';

    $jokesTable = new DatabaseTable( $pdo, 'joke', 'id' );

    if (isset($_POST['joke'])) {

        $joke = $_POST['joke'];
        $joke['jokedate'] = new DateTime();
        $joke['authorid'] = 1;

        $jokesTable -> save( $joke );

        header('location: jokes.php');
    }else {


        if( isset($_GET['id'])){

            $joke = findById( $pdo,'joke', 'id', $_GET['id']);
            
        }

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