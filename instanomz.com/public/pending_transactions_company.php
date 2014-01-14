<?php
    
    // configuration
    require("../includes/config.php");
    
    // array to hold orders that will be rendered
    $orders = array();
    
    // orders for the specific restaurant
    $orders = query("SELECT * FROM pending_order WHERE id_restaurant = ?", $_SESSION["id_company"]);
    
    // checks if there are any orders
    if (empty($orders))
    {
        apologize(array("You have no pending orders."), 2);
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
    render("pending_transactions_form_company.php", ["transactions" => $transactions, "title" => "Current Menu"], 2);

    
?>
