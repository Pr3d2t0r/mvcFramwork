<nav>
    <ul>
        <li><a href="<?php echo HOME_URI;?>">Home</a></li>
        <?php if (!$this->isUserLogedIn()): ?>
            <li><a href="<?php echo HOME_URI;?>register/">Register</a></li>
            <li><a href="<?php echo HOME_URI;?>login/">Login</a></li>
        <?php else: ?>
            <li><a href="<?php echo HOME_URI;?>login/logout">Logout</a></li>
            <li><a href="<?php echo HOME_URI;?>login/logout/all">Logout All</a></li>
            <li>Welcome <?php echo $this->userInfo->username; ?></li>
        <?php endif; ?>
    </ul>
</nav>