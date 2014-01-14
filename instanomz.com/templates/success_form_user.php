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

<br/>

           
Thank you for your order!<br/><br/>

<?php
    
    printf("The date and time of your order is: %s.<br/><br/>", date("n/j/y, g:ia", strtotime($datetime)));
    
    foreach ($order["food"] as $key => $food)
    {
        printf("%s %s at $%s each<br/>", number_format($order["quantity"][$key], 0), htmlspecialchars($food), number_format($order["price"][$key], 2));
    }
    
    printf("<br/>The total cost is: $%s<br/><br/>The Order Status is: Unconfirmed<br/><br/>The Order Id is: %s<br/><br/>", number_format($cost, 2), htmlspecialchars($id));
    
?>

Track its progress via "Pending Transactions" or check your email as updates will be sent to you.
