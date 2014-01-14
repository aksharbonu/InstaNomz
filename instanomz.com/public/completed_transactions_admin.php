<?php
    
    // configuration
    require("../includes/config.php");
    
    // finds all completed orders
    $orders = query("SELECT * FROM completed_order");
    
    // checks if there are any
    if (empty($orders))
    {
        apologize(array("You have no completed orders!"), 3);
    }
    
    // render completed transactions
    render("completed_transactions_form_admin.php", ["orders" => $orders, "title" => "Current Menu"], 3);

    
?>
