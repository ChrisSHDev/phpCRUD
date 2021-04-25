<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/jokes.css">
    <title><?= $title ?></title>
</head>
<body>
    <header>
        <h1>php Joke Board</h1>
    </header>
    <nav class="navbar navbar-dark bg-dark">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/joke/list">Jokes</a></li>
            <li><a href="/joke/edit">ADD Jokes</a></li>

            <?php if ($loggedIn) : ?>
            <li><a href="/logout">Log Out</a></li>
            <?php else : ?>
            <li><a href="/login">Log In</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <main>
        <?= $output ?>
    </main>

    <footer>
        &copy; IJDB 2021
    </footer>
</body>
</html>