<?php
    
    // configuration
    require("../includes/config.php");
    
    // data sent from new_item_form_company.php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
            // sets availability of new item based on restaurant input
            $available;
            
            if (empty($_POST["available"]))
            {
                $available = 0;
            }
            else
            {
                $available = 1;
            }
    
            // inserts the item into the database
            query("INSERT INTO menu (food, description, price, available, id) VALUES( ? , ?, ?, ?, ?) ON DUPLICATE KEY UPDATE description = ?, price = ?, available = ?", $_POST['food'], $_POST['description'], $_POST['price'], $available, $_SESSION['id_company'], $_POST['description'], $_POST['price'], $available);
    
            // redirects to current menu
            redirect("index_company.php");
        
    }
    else
    {
        // render new item form
        render("new_item_form_company.php", ["title" => "Add New Item"], 2);
    }
    
?>
