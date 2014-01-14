<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize(array("You must provide your username."), 1);
        }
        else if (empty($_POST["password"]))
        {
            apologize(array("You must provide your password."), 1);
        }

        // query database for user
        $rows = query("SELECT * FROM users WHERE username = ?", $_POST["username"]);

        // if we found user, check password
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];

            // compare hash of user's input against hash that's in database
            if (crypt($_POST["password"], $row["hash"]) == $row["hash"])
            {
                // remember that user's now logged in by storing user's ID in session
                $_SESSION["id"] = $row["id"];
                redirect("/");
            }
        }

        // else apologize
        apologize(array("Invalid username and/or password."), 1);
    }
    else
    {
        // else render form
        render("login_form_user.php", ["title" => "Log In"], 1);
    }

?>
