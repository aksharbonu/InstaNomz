<?php
    
    // configuration
    require("../includes/config.php");
    
    // recieves input from update_form_company.php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // update clicked
        if($_POST["action"] == 1)
        {
            // interpert if restaurant owner said new menu item is available (1) or not (0)
            $available;
            
            if (empty($_POST["available"]))
            {
                $available = 0;
            }
            else
            {
                $available = 1;
            }
            
            // update database
            query("UPDATE menu SET food = ?, description = ?, price = ?, available = ? WHERE uniqueid = ?", $_POST["food"], $_POST["description"], $_POST["price"], $available, $_POST["uniqueid"]);
            
        }
        // delete clicked
        else if ($_POST["action"] == 0)
        {
            query("DELETE FROM menu WHERE uniqueid = ? ", $_POST["uniqueid"]);
        }
        
        // redirect to main page
        redirect("index_company.php");
    }
    
?>
