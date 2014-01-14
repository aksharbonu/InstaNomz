<!-- The Menu -->

<ul class="nav nav-pills">
    <li><a href="index_company.php"><strong>Current Menu</strong></a></li>
    <li><a href="new_item_company.php"><strong>New Item</strong></a></li>
    <li><a href="pending_transactions_company.php"><strong>Pending Transactions</strong></a></li>
    <li><a href="completed_transactions_company.php"><strong>Completed Transactions</strong></a></li>
    <li><a href="logout_company.php"><strong>Log Out</strong></a></li>
</ul>

<form action="new_item_company.php" method="post">

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
            printf("<td><input class = 'form-control' name = 'food' placeholder = 'Name' type = 'text'/></td>");
            printf("<td><input class = 'form-control' name = 'description' placeholder = 'Description' type = 'text'/></td>");
            printf("<td><input class = 'form-control' name = 'price' placeholder = 'Price' type = 'text'/></td>");
            printf("<td><input type='checkbox' name= 'available' value= '1' checked></td>");
            printf("</tr>");
    ?>

    </tbody>

</table>

    <td><button type='submit' class='btn btn-default' name = 'action'>Add Item</button></td>

</form>
