<?php
    
    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $row = query("SELECT * FROM menu WHERE uniqueid = ?", $_POST["uniqueid"]);

        // one and only row
        $fooditem = $row[0];
        
        render("update_form_company.php", ["fooditem" => $fooditem, "title" => "Update Menu Item"], 2);
    }
    else
    {
        // get restaurant's menu
        $menu = query("SELECT * FROM menu WHERE id = ?", $_SESSION["id_company"]);
        
        if ($menu === false)
        {
            apologize(array("Can't find your menu."), 2);
        }
    
        // render menu
        render("menu_company.php", ["menu" => $menu, "title" => "Current Menu"], 2);
    }
    
?>
