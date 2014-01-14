<?php
    
    // configuration
    require("../includes/config.php");
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // array to hold all possible errors
        $errors = array();
        
        // validate name
        if (empty($_POST["name"]))
        {
            $errors[] = "You must provide your name.";
        }
        
        // validate dorm
        if (empty($_POST["dorm"]))
        {
            $errors[] = "You must provide your dorm.";
        }
        
        // validate email
        if (empty($_POST["email"]))
        {
            $errors[] = "You must provide your E-Mail.";
        }
        else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        {
           $errors[] = "You must provide a valid E-Mail.";
        }
        
        // validate mobile number
        if (empty($_POST["mobilenumber"]))
        {
            $errors[] = "You must provide your mobile number.";
        }
        // http://ericholmes.ca/php-phone-number-validation-revisited/
        else if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $_POST["mobilenumber"]))
        {
                 $errors[] = "You must provide a valid mobile number.";
        }
        
        // if errors exist, apologize
        if (!empty($errors))
        {
            apologize($errors, 1);
        }
        
        // otherwise set guest in $_SESSION
        $_SESSION["guest"] = $_POST;
        
        // go to current offerings
        redirect("/");
        
    }
    else
    {
        // else render form
        render("guest_form_user.php", ["title" => "Guest"], 1);
    }
    
    ?>
