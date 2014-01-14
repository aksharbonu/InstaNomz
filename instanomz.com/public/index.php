<?php

    // configuration
    require("../includes/config.php");
    
    // checks if the user is meant to be redirected to a different page
    if (!empty($_SESSION["next_page"]))
    {
        $nextpage = $_SESSION["next_page"];
        $_SESSION["next_page"] = 0;
        redirect($nextpage);
    }
    // displays current offerings
    else
    {
        // gets restaurant data (names, opening image)
        $rows = query("SELECT * FROM restaurants_data");
        if ($rows === false)
        {
            apologize(array("There was an error!"), 1);
        }
        
        // name of person (either guest or name of logged in user)
        $name = "";
        
        if (!empty($_SESSION["guest"]))
        {
            // get name from guest data if guest
            $name = $_SESSION["guest"]["name"];
        }
        else if (!empty($_SESSION["id"]))
        {
            // retrieve name from database
            $names = query("SELECT name FROM users WHERE id = ?", $_SESSION["id"]);
            $name = $names[0]["name"];
        }
        
        // render page
        render("offerings_user.php", ["title" => "Participating Restaurants", "restaurants" => $rows, "name" => $name], 1);
    }  
?>

