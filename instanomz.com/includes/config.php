<?php

    /**
     * config.php
     *
     * Computer Science 50
     * Problem Set 7 (Adapted for CS50 Final Project)
     *
     * Configures pages.
     */

    // display errors, warnings, and notices
    ini_set("display_errors", true);
    error_reporting(E_ALL);

    // requirements
    require("constants.php");
    require("functions.php");

    // enable sessions
    session_start();
    
    // must log-in as restaurant to see these parts of the restaurant site
    if (preg_match("{(?:index_company|update_company|new_item_company|pending_transactions_company|completed_transactions_company)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if (empty($_SESSION["id_company"]))
        {
            redirect("login_company.php");
        }
    }
    // must log-in as user/guest to see these parts of the user site
    else if (preg_match("{(?:confirm_order_user|pending_transactions_user|completed_transactions_user)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if (empty($_SESSION["id"]) && empty($_SESSION["guest"]))
        {
            redirect("/");
        }
    }
    // must log-in as admin to see these parts of the admin site
    else if (preg_match("{(?:index_admin|pending_transactions_admin|completed_transactions_admin)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if (empty($_SESSION["id_admin"]))
        {
            redirect("login_admin.php");
        }
    }
    
?>
