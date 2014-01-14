<!-- The Menu (changes based on whether the user is logged in or not as guest/user) -->

<ul class="nav nav-pills">
    <li><a href="index.php"><strong>Current Offerings</strong></a></li>
</ul>

<form action="login_user.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autofocus class="form-control" name="username" placeholder="Username" type="text"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="password" placeholder="Password" type="password"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Log In</button>
        </div>
    </fieldset>
</form>

<div>
    or <a href="guest_user.php">Log In As A Guest</a>
    or <a href="register_user.php">Sign Up</a>
</div>