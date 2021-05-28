    <div class="jokelist">
      <ul class="categories">
        <?php foreach ($categories as $category): ?>
        <li><a href="/joke/list?category=<?php echo $category -> id?>"><?php echo $category->name?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <p>There are <?php echo $totalJokes ?> Jokes in total.</p>

    <?php foreach ($jokes as $joke): ?>
    <blockquote>
      <p>
        <?php echo htmlspecialchars($joke -> joketext, ENT_QUOTES, 'UTF-8')  ?>

        (Author:

        <a href="mailto:<?php echo htmlspecialchars($joke -> getAuthor() -> email, ENT_QUOTES, 'UTF-8') ?>">
          <?php echo htmlspecialchars($joke -> getAuthor() -> name, ENT_QUOTES, 'UTF-8') ?>
        </a>
        Date: <?php echo $joke -> jokedate; ?>
        )
        <?php if ($user) : ?>
        <?php if ($user->id == $joke->authorid || $user -> hasPermission(\Ijdb\Entity\Author::EDIT_JOKES)): ?>
        <a href="/joke/edit?id=<?php echo $joke -> id?>">Edit</a>
        <?php endif; ?>

        <?php if ($user -> id == $joke -> authorid || $user -> hasPermission(\Ijdb\Entity\author::DELETE_JOKES)): ?>
      <form action="/joke/delete" method="post">
        <input type="hidden" name="id" value="<?=$joke -> id?>">
        <input type="submit" value="Delete">
      </form>
      <?php endif; ?>
      <?php endif; ?>
      </p>
    </blockquote>
    <?php endforeach; ?>

    <div class="jokelist">
      <ul class="categories">
        <?php foreach ($categories as $category): ?>
        <li><a href="/joke/list?category=<?php echo $category -> id?>"><?php echo $category->name?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>