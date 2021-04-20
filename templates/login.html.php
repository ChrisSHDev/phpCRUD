<?php 
if(isset($error)):
    echo '<div class="errors">' . $error . '</div>';
endif;
?>

<form action="" method="post">
    <label for="email">Email: </label>
    <input type="text" name="author[email]" id="email">

    <label for="password">Password: </label>
    <input type="password" name="author[password]" id="password">

    <input type="submit" name="submit" value="Log In">
</form>

<p>No Account? <a href="/author/register">Sing-in</a> now!</p>