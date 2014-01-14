<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize(array("You must provide your username."), 2);
        }
        else if (empty($_POST["password"]))
        {
            apologize(array("You must provide your password."), 2);
        }

        // query database for user
        $rows = query("SELECT * FROM restaurants WHERE username = ?", $_POST["username"]);

        // if we found user, check password
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];

            // compare hash of user's input against hash that's in database
            if (crypt($_POST["password"], $row["hash"]) == $row["hash"])
            {
                // remember that user's now logged in by storing user's ID in session
                $_SESSION["id_company"] = $row["id"];

                // redirect to portfolio
                redirect("index_company.php");
            }
        }

        // else apologize
        apologize(array("Invalid username and/or password."), 2);
    }
    else
    {
        // else render form
        render("login_form_company.php", ["title" => "Log In"], 2);
    }

?>
