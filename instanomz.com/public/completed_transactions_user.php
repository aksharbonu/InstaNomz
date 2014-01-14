<?php
    
    // configuration
    require("../includes/config.php");
    
    // holds completed transactions
    $orders = array();
    
    // checks if guest or user logged in
    if (!empty($_SESSION["guest"]))
    {
        // checks if there are any menu items that have been ordered
        if (!empty($_SESSION["uniqueid"]))
        {
            //  if any of the menu items are completed orders adds them to orders array
            foreach($_SESSION["uniqueid"] as $id)
            {
                $menuitem = query("SELECT * FROM completed_order WHERE id = ?", $id);
                if(!empty($menuitem))
                {
                    $orders[] = $menuitem[0];
                }
            }
        }
        
        // if no completed orders, apologize
        if(empty($orders))
        {
            apologize(array("You have no completed orders!"), 1);
        }

    }
    else
    {
        // gets completed orders for logged in user using his/her id
        $orders = query("SELECT * FROM completed_order WHERE id_user = ?", $_SESSION["id"]);
        
        if (empty($orders))
        {
            apologize(array("You have no completed orders!"), 1);
        }
    }
    
    // render pending transactions
    render("completed_transactions_form_user.php", ["orders" => $orders, "title" => "Current Menu"], 1);

    
?>
