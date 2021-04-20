<?php 
if( !empty($errors) ):
?>

<div class="errors">
    <p> You can't register your account, please check the error messages.</p>
    <ul>
        <?php foreach($errors as $error): ?>
        <li><?php echo $error ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<?php endif; ?>

<form action="" method="post">
<label for="email">Email: </label>
<input type="text" name="author[email]" id="email" value="<?php echo $author['email']?>">

<label for="name">Name: </label>
<input type="text" name="author[name]" id="name" value="<?php echo $author['name'] ?>">

<label for="password">Password: </label>
<input type="password" name="author[password]" id="password">

<input type="submit" name="submit" value="Register">
</form>