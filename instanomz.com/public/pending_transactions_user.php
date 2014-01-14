<?php
    
    // configuration
    require("../includes/config.php");
    
    // array to hold orders that will be rendered
    $orders = array();
    
    // check if user is logged in as a guest
    if (!empty($_SESSION["guest"]))
    {
        // checks if the guest has made any orders
        if (!empty($_SESSION["uniqueid"]))
        {
            // populates array with orders that are currently pending by guest
            foreach($_SESSION["uniqueid"] as $id)
            {
                $menuitem = query("SELECT * FROM pending_order WHERE id = ?", $id);
                if (!empty($menuitem))
                {
                    $orders[] = $menuitem[0];
                }
            }
        }
        
        // if no pending orders, apologize
        if(empty($orders))
        {
            apologize(array("You have no completed orders!"), 1);
        }

    }
    // finds pending orders for logged-in user
    else
    {
        $orders = query("SELECT * FROM pending_order WHERE id_user = ?", $_SESSION["id"]);
        
        if (empty($orders))
        {
            apologize(array("You have no pending orders."), 1);
        }
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
    render("pending_transactions_form_user.php", ["transactions" => $transactions, "title" => "Current Menu"], 1);

    
?>
