<!-- The Menu -->

<ul class="nav nav-pills">
    <li><a href="index.php"><strong>Current Offerings</strong></a></li>
</ul>

<form action="register_user.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autofocus class="form-control" name="username" placeholder="Username" type="text"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="password" placeholder="Password" type="password"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="confirmation" placeholder="Password (again)" type="password"/>
        </div>
        <div class="form-group">
            <input autofocus class="form-control" name="name" placeholder="Name" type="text"/>
        </div>
        <div class="form-group">
            <input autofocus class="form-control" name="email" placeholder="E-Mail" type="text"/>
        </div>
        <div class="form-group">
            <input autofocus class="form-control" name="dorm" placeholder="Dorm & Dorm Number" type="text"/>
        </div>
        <div class="form-group">
            <input autofocus class="form-control" name="mobilenumber" placeholder="Mobile Number" type="text"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn">Register</button>
        </div>
    </fieldset>
</form>
<div>
    or <a href="login_user.php">Log In</a>
    or <a href="guest_user.php">Log In As A Guest</a>
</div>
