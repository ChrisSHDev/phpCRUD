<?php 
if(isset($error)):
    echo '<div class="errors">' . $error . '</div>';
endif;
?>

<form action="" method="post">
    <label for="email">Email: </label>
    <input type="text" name="email" id="email">

    <label for="password">Password: </label>
    <input type="password" name="password" id="password">

    <input type="submit" name="submit" value="Log In">
</form>

<p>No Account? <a href="/author/register">Sing-in</a> now!</p>