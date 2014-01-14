<!-- The Menu -->

<ul class="nav nav-pills">
    <li><a href="index_admin.php"><strong>Pending transactions</strong></a></li>
    <li><a href="completed_transactions_admin.php"><strong>Completed transactions</strong></a></li>
    <li><a href="logout_admin.php"><strong>Log Out</strong></a></li>
</ul>

<form action="index_admin.php" method="post">

<table class="table table-striped">

    <thead>
        <tr>
            <th>Point in Delivery</th>
            <th>Order Id</th>
            <th>Contact Information</th>
            <th>Date/Time of Order</th>
            <th>Restaurant</th>
            <th>Food</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Cost</th>
            <th>Update</th>
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
                        printf("<tr><th colspan='10'><b>Unconfirmed</b></th></tr>");
                        break;
                    case 1:
                        printf("<tr><th colspan='10'><b>At Restaurant</b></th></tr>");
                        break;
                    case 2:
                        printf("<tr><th colspan='10'><b>En Route</b></th></tr>");
                        break;
                }
                
                foreach ($type as $item)
                {
                    $foods = unserialize($item["foods"]);
                    
                    printf("<tr><td></td>");
                    
                    printf("<td>%s</td>", htmlspecialchars($item["id"]));
                    
                    printf("<td>%s<br/>%s<br/>%s<br/>%s<br/></td>", htmlspecialchars($item["name"]), htmlspecialchars($item["email"]), htmlspecialchars($item["mobilenumber"]), htmlspecialchars($item["dorm"]));
                    
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
                    
                    printf("<td><button type= 'submit' name = 'uniqueid' value='%s'>Update</button></td>", htmlspecialchars($item["id"]));
                    
                    printf("</tr>");
                }
            }
        }
        
        ?>

    </tbody>

</table>

</form>
