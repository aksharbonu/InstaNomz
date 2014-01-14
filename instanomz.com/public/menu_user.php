<?php
    
    // configuration
    require("../includes/config.php");
    
    // data sent from menu_form_user.php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // bool to see if at least one legitimate order made
        $orderExists = FALSE;
        
        foreach ($_POST as $key => $value)
        {
            // only check if key-value pair is of food item unique id and quantity ordered
            if ($key != "id")
            {
                // see if user put a value in to order for specific id
                if (!empty($value))
                {
                    // check if the value is a positive integer
                    if (filter_var($value, FILTER_VALIDATE_INT) && $value > 0)
                    {
                        $orderExists = TRUE;
                    }
                    else
                    {
                        unset($_POST[$key]);
                    }
                }
                // if nothing put in for quantity, remove key-value pair
                else
                {
                    unset($_POST[$key]);
                }
            }
        }
        
        // see if at least one order made
        if ($orderExists)
        {
            // saves the current_order in the $_SESSION so menu will be pre-populated
            $_SESSION["current_order"] = $_POST;
        
            // if user is logged in either a guest or log-in go to confirmation page
            if (!empty($_SESSION["id"]) || !empty($_SESSION["guest"]))
            {
                redirect("confirm_order_user.php");
            }
            // otherwise direct them to log-in
            else
            {
                // after log-in, direct user to confirm their order
                $_SESSION["next_page"] = "confirm_order_user.php";
                $order = $_SESSION["current_order"];
                render("choice_form_user.php", ["order" => $order, "title" => "Log In, Sign Up, or Be a Guest"], 1);
            }
        }
        // if not one legitimate order made, make them retry
        else
        {
            apologize(array("You must pick at least one thing to order"), 1);
        }
    }
    else
    {
        // redirect if the user should not be here or $_GET has not been set
        // TODO: handle incorrect $_GET value
        
        if (empty($_GET["id"]))
        {
            redirect("/");
        }
        // get restaurant's menu
        else
        {
            
            $menu = query("SELECT * FROM menu WHERE id = ?", $_GET["id"]);
        
            if ($menu === false)
            {
                apologize(array("Can't find your menu."), 1);
            }
            
            // holds quantity of food currently saved in the current order (if it has been set)
            $data = array();
            
            if(!empty($_SESSION["current_order"]))
            {
                // only fills data array if current order matches restaurant menu currently selected
                if ($_SESSION["current_order"]["id"] == $_GET["id"])
                {
                    foreach ($_SESSION["current_order"] as $key => $value)
                    {
                        if($key != "id")
                        {
                            $data[$key] = $value;
                        }
                    }
                }
            }
            
            // render menu
            render("menu_form_user.php", ["menu" => $menu, "title" => "Menu", "data" => $data], 1);
        }
    }
    
?>
