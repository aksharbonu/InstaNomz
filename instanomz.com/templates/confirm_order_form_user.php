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

           
<form action="confirm_order_user.php" method="post">

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
        
        foreach ($selectedmenu as $menuitem)
        {
            
            printf("<input type= 'hidden' name= '%s' value= '%s'/>", htmlspecialchars($menuitem["food"]), htmlspecialchars($menuitem["quantity"]));
            
            printf("<tr>");
            printf("<td>%s</td>", htmlspecialchars($menuitem["food"]));
            printf("<td>%s</td>", htmlspecialchars($menuitem["description"]));
            printf("<td>$%s</td>", number_format($menuitem["price"], 2));
            printf("<td>Yes</td>");
            
            printf("<td><input placeholder='%s' type='number' disabled/></td>", htmlspecialchars($menuitem["quantity"]));
            printf("</tr>");
        }
    ?>
    <tr>
        <td colspan="2">Total Cost</td>
        <td>$<?= number_format($cost, 2) ?></td>
    </tr>

    </tbody>

</table>

    <?php printf("<input type= 'hidden' name= 'cost' value= '%s'/>", $cost); ?>
    <button type='submit' name = 'action' value = '1' >Submit Order</button>
    <button type='submit' name = 'action' value = '2' >Edit</button>
    <button type='submit' name = 'action' value = '3' >Cancel</button>

</form>
