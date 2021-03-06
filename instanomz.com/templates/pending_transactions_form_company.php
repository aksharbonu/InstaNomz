<!-- The Menu -->

<ul class="nav nav-pills">
    <li><a href="index_company.php"><strong>Current Menu</strong></a></li>
    <li><a href="new_item_company.php"><strong>New Item</strong></a></li>
    <li><a href="pending_transactions_company.php"><strong>Pending Transactions</strong></a></li>
    <li><a href="completed_transactions_company.php"><strong>Completed Transactions</strong></a></li>
    <li><a href="logout_company.php"><strong>Log Out</strong></a></li>
</ul>

<table class="table table-striped">

    <thead>
        <tr>
            <th>Point in Delivery</th>
            <th>Order Id</th>
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
        foreach($transactions as $key => $type)
        {
            if (!empty($type))
            {
                switch ($key)
                {
                    case 0:
                        printf("<tr><th colspan='8'><b>Unconfirmed</b></th></tr>");
                        break;
                    case 1:
                        printf("<tr><th colspan='8'><b>At Restaurant</b></th></tr>");
                        break;
                    case 2:
                        printf("<tr><th colspan='8'><b>En Route</b></th></tr>");
                        break;
                }

                foreach ($type as $item)
                {
                    $foods = unserialize($item["foods"]);
                    
                    printf("<tr><td></td>");
                    
                    printf("<td>%s</td>", htmlspecialchars($item["id"]));
                    
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
        }
            
    ?>

    </tbody>

</table>
