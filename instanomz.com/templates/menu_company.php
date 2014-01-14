<!-- The Menu -->

<ul class="nav nav-pills">
    <li><a href="index_company.php"><strong>Current Menu</strong></a></li>
    <li><a href="new_item_company.php"><strong>New Item</strong></a></li>
    <li><a href="pending_transactions_company.php"><strong>Pending Transactions</strong></a></li>
    <li><a href="completed_transactions_company.php"><strong>Completed Transactions</strong></a></li>
    <li><a href="logout_company.php"><strong>Log Out</strong></a></li>
</ul>


<form action="index_company.php" method="post">

<table class="table table-striped">

    <thead>
        <tr>
            <th>Food</th>
            <th>Description</th>
            <th>Price</th>
            <th>In Stock</th>
            <th>Edit</th>
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
            }
            else
            {
                printf("<td>No</td>");
            }
            
            printf("<td><button type= 'submit' name = 'uniqueid' value='%s'>Edit</button></td>", htmlspecialchars($menuitem["uniqueid"]));
            printf("</tr>");
        }

    ?>

    </tbody>

</table>

</form>
