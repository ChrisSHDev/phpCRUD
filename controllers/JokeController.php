<?php 

class JokeController{
    private $authorsTable;
    private $jokesTable;

    public function __construct( DatabaseTable $jokesTable, DatabaseTable $authorsTable )
    {
        $this -> jokesTable = $jokesTable;
        $this -> authorsTable = $authorsTable;
    }

    public function list() {
        $result = $this -> jokesTable -> findAll();

        $jokes = [];

        foreach ( $result as $joke ) {
            $author = $this -> authorsTable -> findById( $joke['authorid']);

            $jokes[] = [
                'id' => $joke['id'],
                'joketext' => $joke['joketext'],
                'jokedate' => $joke['jokedate'],
                'name' => $author['name'],
                'email' => $author['email']
            ];

        }


        $title = 'Joke Board';

        $totalJokes = $this -> jokesTable -> total();

            return ['template' => 'jokes.html.php', 
                     'title' => $title,
                     'variables' => [
                        'totalJokes' => $totalJokes,
                        'jokes' => $jokes
                     ]
                    ];
    }

    public function home() {
        $title = 'Online Joke World';

        return [ 'template' => 'home.html.php', 'title' => $title ];
    }

    public function delete() {
        $this -> jokesTable -> delete( $_POST{'id'});

        header('location: jokes.php');
    }

    public function edit() {
        if( isset( $_POST['joke'])) {
            $joke = $_POST['joke'];
            $joke['jokedate'] = new DateTime();
            $joke['authorid'] = 1;
            var_dump($joke);
            $this -> jokesTable -> save($joke);

            header( 'location: index.php?action=list');
        }
        else {
            
            if(isset( $_GET['id'])){
                $joke = $this -> jokesTable -> findById( $_GET['id']);
            }

            $title = 'Edit Joke Article';

            return ['template' => 'editjoke.html.php', 
                    'title' => $title,
                    'variable' => [
                        'joke' => $joke ?? null
                    ]
                    
                ];
        }
    }
}