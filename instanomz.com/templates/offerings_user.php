<!-- The Menu (changes based on whether the user is logged in or not as guest/user) -->

<ul class="nav nav-pills">
    <li><a href="index.php"><strong>Current Offerings</strong></a></li>

    <?php
        if(empty($_SESSION["guest"]) && empty($_SESSION["id"]))
        {
            printf("<li><a href='login_user.php'><strong>Log In</strong></a></li>");
            printf("<li><a href='register_user.php'><strong>Sign Up</strong></a></li>");
            printf("<li><a href='guest_user.php'><strong>Sign Up as Guest</strong></a></li>");
        }
        else
        {
            printf("<li><a href='pending_transactions_user.php'><strong>Pending Transactions</strong></a></li>");
            printf("<li><a href='completed_transactions_user.php'><strong>Completed Transactions</strong></a></li>");
            
            if(!empty($_SESSION["guest"]))
            {
                printf("<li><a href='logout_user.php'><strong>Log Out of Guest</strong></a></li>");
            }
            else if(!empty($_SESSION["id"]))
            {
                printf("<li><a href='logout_user.php'><strong>Log Out</strong></a></li>");
            }
        }
    ?>

</ul>

<!-- Displays name if user is logged in as a user or as a guest -->

<?php if(!empty($name))
{
    printf("<br/>Hello %s!", $name);
} ?>

<!-- Displays current offerings of restaurants (clickable image) linking to menu_user.php and sends data via GET -->

<table class="table table-striped" style="margin: auto;">

    <thead>
        <tr>
            <th>Pick A Restaurant To Order From</th>
        </tr>
    </thead>

    <tbody>

    <?php
        foreach ($restaurants as $restaurant)
        {
            printf("<tr>");
            printf("<td><a href='menu_user.php?id=%s'><img alt='%s' src='/img/%s'/></a></td>", htmlspecialchars($restaurant["id"]), htmlspecialchars($restaurant["name"]), htmlspecialchars($restaurant["opening_image"]));
            printf("</tr>");
        }

    ?>

    </tbody>

</table>
