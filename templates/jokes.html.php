    <p>There are <?php echo $totalJokes ?> Jokes in total.</p>
    
    <?php foreach ( $jokes as $joke ): ?>
    <blockquote>
        <p>
            <?php echo htmlspecialchars( $joke['joketext'], ENT_QUOTES, 'UTF-8')  ?>

            (Author:   
            
            <a href="mailto:<?php echo htmlspecialchars( $joke['email'], ENT_QUOTES, 'UTF-8') ?>">
                <?php echo htmlspecialchars( $joke['name'], ENT_QUOTES, 'UTF-8') ?>
            </a>
            Date: <?php echo $joke['jokedate']; ?>
            )

            <a href="/joke/edit?id=<?php echo $joke['id']?>">Edit</a>
            
            <form action="/joke/delete" method="post">
                <input type="hidden" name="id" value="<?=$joke['id']?>">
                <input type="submit" value="Delete">
            </form>
        </p>
    </blockquote>
    <?php endforeach; ?>