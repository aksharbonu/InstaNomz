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

<table class="table table-striped">

    <thead>
        <tr>
            <th>Date/Time of Order</th>
            <th>Restaurant</th>
            <th>Food</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Cost</th>
        </tr>
    </thead>

    <tbody>

    <?php 
        if (!empty($orders))
        {
            
            foreach ($orders as $item)
            {
                $foods = unserialize($item["foods"]);
                
                printf("<tr>");
                
                printf("<td>%s</td>", date("n/j/y, g:ia", strtotime($item["datetime"])));
                
                printf("<td>%s</td>", htmlspecialchars($item["name_restaurant"]));
                
                printf("<td>");
                foreach ($foods["food"] as $food)
                {
                    printf("%s<br/>", htmlspecialchars($food));
                }
                printf("</td>");
                
                printf("<td>");
                foreach ($foods["price"] as $price)
                {
                    printf("$%s<br/>", number_format($price, 2));
                }
                printf("</td>");
                
                printf("<td>");
                foreach ($foods["quantity"] as $quantity)
                {
                    printf("%s<br/>", number_format($quantity, 0));
                }
                printf("</td>");

                printf("<td>$%s</td>", number_format($item["cost"], 2));
                
                printf("</tr>");
            }
        }
    ?>

    </tbody>

</table>
