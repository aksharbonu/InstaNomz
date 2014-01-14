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

           
<form action="menu_user.php" method="post">

<table class="table table-striped">

    <thead>
        <tr>
            <th>Food</th>
            <th>Description</th>
            <th>Price</th>
            <th>In Stock</th>
            <th>Number</th>
        </tr>
    </thead>

    <tbody>

    <?php 
        
        foreach ($menu as $menuitem)
        {
            printf("<tr>");
            printf("<td>%s</td>", htmlspecialchars($menuitem["food"]));
            printf("<td>%s</td>", htmlspecialchars($menuitem["description"]));
            printf("<td>$%s</td>", number_format($menuitem["price"], 2));
            if ($menuitem["available"] === 1)
            {
                printf("<td>Yes</td>");
                if (!empty($data[$menuitem["uniqueid"]]))
                {
                    printf("<td><input name= '%s' placeholder='Quantity' type='number' min = '1' step = '1' value = '%s'/></td>", htmlspecialchars($menuitem["uniqueid"]), htmlspecialchars($data[$menuitem["uniqueid"]]));
                }
                else
                {
                    printf("<td><input name= '%s' placeholder='Quantity' type='number' min = '1' step = '1'/></td>", htmlspecialchars($menuitem["uniqueid"]));
                }
            }
            else
            {
                printf("<td>No</td>");
                printf("<td><input placeholder='Unavailable' type='text' disabled/></td>");
            }
            printf("</tr>");
        }
    ?>
    </tbody>

</table>

<?php
    printf("<button type='submit' name = 'id' value = '%s' >Submit Order</button>", htmlspecialchars($menu[0]["id"]));
?>

</form>
