<div>
    <p>Login</p>
    <form action="<?php echo HOME_URI; ?>login/" method="post">
        <input type="text" name="username" placeholder="Username"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <?php if ($nextPage != null): ?>
            <input type="hidden" name="nextPage" value="<?php echo $nextPage; ?>">
        <?php endif; ?>
        <input type="submit" value="Login">
    </form>
</div>