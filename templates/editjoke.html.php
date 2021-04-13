<form action="" method="post">
    <input type="hidden" name="jokeid" value="<?php echo $joke['id'];?>">
    <label for="joketext">Please enter joke article:</label>
    <textarea name="joketext" id="joketext" cols="30" rows="3">
        <?php echo $joke['joketext'] ?>
    </textarea>
    <input type="submit" value="Submit">
</form>