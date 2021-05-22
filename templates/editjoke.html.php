<?php if (empty($joke -> id) || $userId == $joke -> authorid): ?>

<form action="" method="post">
  <input type="hidden" name="joke[id]" value="<?php echo $joke -> id ?? ''; ?>">
  <label for="joketext">Please enter joke article:</label>
  <textarea name="joke[joketext]" id="joketext" cols="30" rows="3">
        <?php echo $joke -> joketext ?? ''; ?>
    </textarea>
  <p>Categories:</p>
  <?php foreach ($categories as $category): ?>
  <input type="checkbox" name="category[]" value="<?php echo $category -> id ?>" />
  <label><?php echo $category -> name ?></label>
  <?php endforeach; ?>
  <input type="submit" name="submit" value="Submit">
</form>
<?php else: ?>

<p>You can edit only your own article.</p>

<?php endif; ?>