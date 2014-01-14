<!-- The Menu -->

<ul class="nav nav-pills">
    <li><a href="index_admin.php"><strong>Pending transactions</strong></a></li>
    <li><a href="completed_transactions_admin.php"><strong>Completed transactions</strong></a></li>
    <li><a href="logout_admin.php"><strong>Log Out</strong></a></li>
</ul>

<table class="table table-striped">

<tbody>

<form action="update_admin.php" method="post">

    <?php

    // hidden values hold unique id of pending transaction and point in delivery of transaction for comparison in update_admin.php
    printf("<input type= 'hidden' name = 'uniqueid' value= '%s'/>", htmlspecialchars($item["id"]));
    printf("<input type= 'hidden' name = 'originalstatus' value= '%s'/>", htmlspecialchars($item["status"]));
        
    printf("<tr><td>Id</td><td><input autofocus class='form-control' name='id' value='%s' type='text'/></td></tr>", htmlspecialchars($item["id"]));

    printf("<tr><td>Name</td><td><input autofocus class='form-control' name='name' value='%s' type='text'/></td></tr>", htmlspecialchars($item["name"]));

    printf("<tr><td>E-Mail</td><td><input autofocus class='form-control' name='email' value='%s' type='text'/></td></tr>", htmlspecialchars($item["email"]));

    printf("<tr><td>Mobile Number</td><td><input autofocus class='form-control' name='mobilenumber' value='%s' type='text'/></td></tr>", htmlspecialchars($item["mobilenumber"]));

    printf("<tr><td>Dorm</td><td><input autofocus class='form-control' name='dorm' value='%s' type='text'/></td></tr>", htmlspecialchars($item["dorm"]));

    foreach ($foods["food"] as $key => $food)
    {
        printf("<tr><td>%s</td><td><input autofocus class='form-control' name='%s' value='%s' type='text'/></td></tr>", htmlspecialchars($food), htmlspecialchars($food), htmlspecialchars($foods["quantity"][$key]));
    }
    ?>
    <tr>
    <td>Status</td>
    <td>
    <select name = 'status'>
        <?php if($item["status"] == 0) : ?>
            <option value="0" selected>Unconfirmed</option>
            <option value="1">At Restaurant</option>
            <option value="2">En Route</option>
        <?php endif; ?>
        <?php if($item["status"] == 1) : ?>
            <option value="0">Unconfirmed</option>
            <option value="1" selected>At Restaurant</option>
            <option value="2">En Route</option>
        <?php endif; ?>
        <?php if($item["status"] == 2): ?>
            <option value="0">Unconfirmed</option>
            <option value="1">At Restaurant</option>
            <option value="2" selected>En Route</option>
        <?php endif; ?>
    </select>
    </td>

    <tr>
        <td colspan='2'>
            <button type='submit' class='btn btn-default' name = 'action' value = '2' >Completed</button>
            <button type='submit' class='btn btn-default' name = 'action' value = '1' >Update</button>
            <button type='submit' class='btn btn-default' name = 'action' value = '0' >Delete</button>
        </td>
    </tr>

</form>

