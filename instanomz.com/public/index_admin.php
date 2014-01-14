<?php
    
    // configuration
    require("../includes/config.php");
    
    // get data from pending_transactions_form_admin.php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // find the pending_order which the admin wants to edit
        $row = query("SELECT * FROM pending_order WHERE id = ?", $_POST["uniqueid"]);
        
        // one and only row
        $item = $row[0];
        
        // retrives the foods data in array form
        $foods = unserialize($item["foods"]);
        
        // render update form
        render("update_form_admin.php", ["item" => $item, "foods" => $foods, "title" => "Update Menu Item"], 3);
    }
    else
    {
        // gets all pending orders
        $orders = query("SELECT * FROM pending_order");
        
        // checks if any exist
        if (empty($orders))
        {
            apologize(array("You have no pending orders."), 3);
        }
        
        // arrays to hold pending_orders at different stages of delivery
        $unconfirmed = array();
        $at_company = array();
        $enroute = array();
        
        foreach ($orders as $order)
        {
            if ($order["status"] == 0)
            {
                $unconfirmed[] = $order;
            }
            else if ($order["status"] == 1)
            {
                $at_company[] = $order;
            }
            else if ($order["status"] == 2)
            {
                $enroute[] = $order;
            }
        }
        
        // consolidates the different pending orders in one array
        $transactions = array(0 => $unconfirmed, 1 => $at_company, 2 => $enroute);
        
        // render pending transactions
        render("pending_transactions_form_admin.php", ["transactions" => $transactions, "title" => "Pending Orders"], 3);
    }
    
?>
