<div>
    <p>User Register</p>
    <form action="<?php echo HOME_URI; ?>register/" method="post">
        <input type="text" name="username" placeholder="Username"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <input type="password" name="rPassword" placeholder="Password repeat"><br>
        <input type="submit" value="Register">
    </form>
</div>
<?php if($this->msg != null): ?>
    <div class="msgs">
        <p><small style="color:<?php echo ($this->msg[1] == 'success') ? 'green' : 'red';?>;"><?php echo $this->msg[0]; ?></small></p>
    </div>
<?php endif; ?>