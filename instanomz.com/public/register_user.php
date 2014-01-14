<?php
    
    // configuration
    require("../includes/config.php");
    
    // if form was submitted from register_form_user.php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate inputs
        $errors = array();
        
        // validate username
        if (empty($_POST["username"]))
        {
            $errors[] = "You must provide a username.";
        }
        else
        {
            $username = query("SELECT id FROM users WHERE username = ?", $_POST["username"]);
            
            if(!empty($username))
            {
                $errors[] = "That username appears to be taken.";
            }
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
        else
        {
            $email = query("SELECT id FROM users WHERE email = ?", $_POST["email"]);
            
            if(!empty($email))
            {
                $errors[] = "That E-Mail appears to be taken.";
            }
        }
        
        // validates dorm
        if (empty($_POST["dorm"]))
        {
            $errors[] = "You must provide your dorm.";
        }
        
        // validate password
        if (empty($_POST["password"]))
        {
            $errors[] = "You must provide a password.";
        }
        
        if (empty($_POST["confirmation"]) || $_POST["password"] != $_POST["confirmation"])
        {
            $errors[] = "Those passwords did not match.";
        }
        
        // validate name
        if (empty($_POST["name"]))
        {
            $errors[] = "You must provide your name.";
        }
        
        // validate mobilenumber
        if (empty($_POST["mobilenumber"]))
        {
            $errors[] = "You must provide your mobile number.";
        }
        // http://ericholmes.ca/php-phone-number-validation-revisited/
        else if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $_POST["mobilenumber"]))
        {
            $errors[] = "You must provide a valid mobile number.";
        }
        else
        {
            $mobilenumber = query("SELECT id FROM users WHERE mobilenumber = ?", $_POST["mobilenumber"]);
            
            if(!empty($mobilenumber))
            {
                $errors[] = "That mobile number appears to be taken.";
            }
        }

        // errors exist
        if (!empty($errors))
        {
            apologize($errors, 1);
        }
        else
        {
            // try to register user
            $results = query("INSERT INTO users (username, hash, name, email, mobilenumber, dorm) VALUES(?, ?, ?, ?, ?, ?)",
                             $_POST["username"], crypt($_POST["password"])
                             , $_POST["name"], $_POST["email"], $_POST["mobilenumber"], $_POST["dorm"]);
            
            // get new user's ID
            $rows = query("SELECT LAST_INSERT_ID() AS id");
            
            if ($rows === false)
            {
                apologize(array("Can't find your ID."), 1);
            }
            
            $id = $rows[0]["id"];
            
            // log user in
            $_SESSION["id"] = $id;
            
            // redirect to current offerings
            redirect("/");
        }
    }
    else
    {
        // else render form
        render("register_form_user.php", ["title" => "Register"], 1);
    }
    
    ?>
