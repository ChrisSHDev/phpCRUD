<h2>Categories</h2>

<a href="/category/edit">Add Category</a>

<?php foreach ($categories as $category): ?>
<blockquote>
  <p>
    <?php echo htmlspecialchars($category -> name, ENT_QUOTES, 'UTF-8') ?>

    <a href="/category/edit?id<?php echo $category -> id ?>">Edit</a>
  <form action="/category/delete" method="post">
    <input type="hidden" name="id" value="<?php echo $category -> id ?>">
    <input type="submit" value="Delete">
  </form>
  </p>
</blockquote>

<?php endforeach; ?>