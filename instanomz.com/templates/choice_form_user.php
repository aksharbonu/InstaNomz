Since you are not logged in, you must make a choice to proceed: <br/>
<ul class="nav nav-pills">
    <li><a href="login_user.php"><strong>Log In</strong></a></li><br/>
    <li><a href="register_user.php"><strong>Sign Up</strong></a></li><br/>
    <li><a href="guest_user.php"><strong>Sign up as Guest</strong></a></li><br/>
    <?php
        printf("<li><a href='menu_user.php?id=%s'><strong>Back</strong></a></li>", htmlspecialchars($order["id"]));
    ?>
</ul>
