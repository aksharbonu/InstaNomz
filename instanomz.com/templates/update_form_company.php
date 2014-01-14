<!-- The Menu -->

<ul class="nav nav-pills">
    <li><a href="index_company.php"><strong>Current Menu</strong></a></li>
    <li><a href="new_item_company.php"><strong>New Item</strong></a></li>
    <li><a href="pending_transactions_company.php"><strong>Pending Transactions</strong></a></li>
    <li><a href="completed_transactions_company.php"><strong>Completed Transactions</strong></a></li>
    <li><a href="logout_company.php"><strong>Log Out</strong></a></li>
</ul>

<form action="update_company.php" method="post">

<table class="table table-striped">

    <thead>
        <tr>
            <th>Food</th>
            <th>Description</th>
            <th>Price</th>
            <th>In Stock</th>
        </tr>
    </thead>

    <tbody>

    <?php
            printf("<tr>");
            // hidden value holds the unique id of the food item being displayed
            printf("<input type= 'hidden' name = 'uniqueid' value= '%s'/>", htmlspecialchars($fooditem["uniqueid"]));
            printf("<td><input class = 'form-control' name = 'food' value = '%s' type = 'text'/></td>", htmlspecialchars($fooditem["food"]));
            printf("<td><input class = 'form-control' name = 'description' value = '%s' type = 'text'/></td>", htmlspecialchars($fooditem["description"]));
            printf("<td><input class = 'form-control' name = 'price' value = %s type = 'text'/></td>", number_format($fooditem["price"], 2));
        
            if ($fooditem["available"] === 1)
            {
                printf("<td><input type='checkbox' name= 'available' value= '1' checked></td>");
            }
            else
            {
                printf("<td><input type='checkbox' name= 'available' value= '1'></td>");
            }
        
            printf("</tr>");
    ?>

    </tbody>

</table>

    <td><button type='submit' class='btn btn-default' name = 'action' value = '1' >Update</button></td>
    <td><button type='submit' class='btn btn-default' name = 'action' value = '0' >Delete</button></td>

</form>
