<h2>Edit authory of <?php echo $author -> name ?></h2>

<form action="" method="post">
  <?php foreach ($permissions as $name => $value): ?>

  <div>
    <input name="permission[]" type="checkbox" value="<?php echo $value ?>"
      <?php if ($author->hasPermission($value)): echo 'checked'; endif; ?> />
    <label><?php echo $name ?></label>
  </div>
  <?php endforeach; ?>
  <input type="submit" value="Save">
</form>