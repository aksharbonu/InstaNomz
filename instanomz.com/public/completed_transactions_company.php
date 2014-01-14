<?php
    
    // configuration
    require("../includes/config.php");
    
    // gets completed transactions for restaurant
    $orders = query("SELECT * FROM completed_order WHERE id_restaurant = ?", $_SESSION["id_company"]);
    
    // checks if there are any
    if (empty($orders))
    {
        apologize(array("You have no completed orders!"), 2);
    }
    
    // render completed transactions
    render("completed_transactions_form_company.php", ["orders" => $orders, "title" => "Current Menu"], 2);

    
?>
