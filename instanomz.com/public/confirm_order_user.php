<?php
    
    // configuration
    require("../includes/config.php");
    
    // PHPMaile
    require("../includes/class.phpmailer.php");
    
    // data recieved from confirm_order_form_user.php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // user submitted order
        if ($_POST["action"] == 1)
        {
            // variables which will hold data to be inserted into new pending order
            $id_restaurant;
            $id_user;
            $username;
            $name;
            $email;
            $mobilenumber;
            $dorm;
            $cost = $_POST["cost"];
            $order = array();
            
            // arrays that will comprise the $order array
            $food = array();
            $price = array();
            $quantity = array();
            
            // fills the $food, $price, and $quantity array with the current order
            foreach ($_SESSION["current_order"] as $key => $value)
            {
                if ($key != "id")
                {
                    $result = query("SELECT food FROM menu WHERE uniqueid = ?", $key);
                    $food[] = $result[0]["food"];
                    $quantity[] = $_POST[str_replace(" ", "_", $result[0]["food"])];
                    $result = query("SELECT price FROM menu WHERE uniqueid = ?", $key);
                    $price[] = $result[0]["price"];
                }
                // if $key is id, remembers it as the restaurant unique id
                else
                {
                    $id_restaurant = $value;
                }
            }
            
            // fills $order array
            $order["food"] = $food;
            $order["price"] = $price;
            $order["quantity"] = $quantity;
            
            // gets data if guest
            if (!empty($_SESSION["guest"]))
            {
                $id_user = "guest";
                $username = "guest";
                $name = $_SESSION["guest"]["name"];
                $email = $_SESSION["guest"]["email"];
                $mobilenumber = $_SESSION["guest"]["mobilenumber"];
                $dorm = $_SESSION["guest"]["dorm"];
            }
            
            // gets data if logged-in user
            else
            {
                $users = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
                $user = $users[0];
                
                $id_user = $_SESSION["id"];
                $username = $user["username"];
                $name = $user["name"];
                $email = $user["email"];
                $mobilenumber = $user["mobilenumber"];
                $dorm = $user["dorm"];
            }
            
            // gets the name of the restaurant
            $names = query("SELECT name FROM restaurants_data WHERE id = ?", $id_restaurant);
            $name_restaurant = $names[0]["name"];
            
            // gets current datetime
            $datetime = date('Y-m-d H:i:s');
            
            // creates new pending order
            $results = query("INSERT INTO pending_order (foods, cost, id_restaurant, id_user, username, name, email, mobilenumber, dorm, datetime, name_restaurant, status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)",
                             serialize($order), $cost, $id_restaurant, $id_user, $username, $name, $email, $mobilenumber, $dorm, $datetime, $name_restaurant);
            
            // id to hold uniqueid of pending order
            $id;
            
            if ($results === false)
            {
                apologize(array("There was an error in saving this order."), 1);
            }
            else
            {
                $_SESSION["current_order"] = 0;
                $rows = query("SELECT LAST_INSERT_ID() AS id");
                $id = $rows[0]["id"];
                
                // if guest, saves the unique id in $_SESSION
                if (!empty($_SESSION["guest"]))
                {
                    if (empty($_SESSION["uniqueid"]))
                    {
                        $_SESSION["uniqueid"] = array();
                    }
                    
                    if ($rows === false)
                    {
                        apologize(array("Error occured in remembering your transaction"), 1);
                    }
                    
                    $_SESSION["uniqueid"][] = $id;
                }
                
                // sends email to customer and deliverers that there is a new pending order
                $mail = new PHPMailer();
                
                $mail->IsSMTP();
                $mail->Host = "localhost";
                $mail->SMTPAuth = true;
                $mail->Username = "instanomz13";
                $mail->Password = "f*GwzyDK";
                
                
                $mail->From = "donotreply@instanomz.com";
                $mail->FromName = "InstaNomz Team";
                $mail->AddAddress($email, $name);
                $mail->AddAddress("orders@instanomz.com", "InstaNomz Delivery");
                $mail->AddCC("8572778590@tmomail.net");
                
                $mail->AddReplyTo("akshar.bonu@gmail.com", "Akshar Bonu");
                
                $mail->WordWrap = 50;
                $mail->IsHTML(true);
                
                $mail->Subject = "Order Status: Unconfirmed";
                
                $body = sprintf("The date and time of your order is: %s<br/><br/>", date("n/j/y, g:ia", strtotime($datetime)));
                foreach ($order["food"] as $key => $food)
                {
                    $body = $body . sprintf("%s %s at $%s each<br/>", $order["quantity"][$key], $food, $order["price"][$key]);
                }
                
                $body = $body . sprintf("<br/>The total cost is: $%s<br/><br/>The Order Status is: Unconfirmed<br/><br/>The Order Id is: %s<br/><br/>The delivery location is: %s", number_format($cost, 2), $id, $dorm);
                
                $mail->Body = $body;
                
                if(!$mail->Send())
                {
                    echo "Message could not be sent. <p>";
                    echo "Mailer Error: " . $mail->ErrorInfo;
                    exit;
                }
                
                render("success_form_user.php", ["order" => $order, "cost" => $cost, "datetime" => $datetime, "title" => "Success!", "id" => $id], 1);
            }
        }
        // user is editing their current order
        else if($_POST["action"] == 2)
        {
            $order = $_SESSION["current_order"];
            redirect("menu_user.php?id=" . $order["id"]);
        }
        // users pressed cancel so current order is forgotten
        else if($_POST["action"] == 3)
        {
            $_SESSION["current_order"] = 0;
            redirect("/");
        }
    }
    else
    {
        // gets the uniqueid & quantity for the current order
        $data = $_SESSION["current_order"];
        
        // queries for the menu of the restaurant
        $menu = query("SELECT * FROM menu WHERE id = ?", $data["id"]);
        
        // array to hold the specific menu items that is in the current order
        $selectedmenu = array();
        
        
        // array to calculate the cost of the current order
        $cost = 0;
        
        // adds the selected menu items to the selected menu and calculates cost
        foreach ($menu as $menuitem)
        {
            if(!empty($data[$menuitem["uniqueid"]]))
            {
                $menuitem["quantity"] = $data[$menuitem["uniqueid"]];
                $cost = $cost + $menuitem["price"] * $menuitem["quantity"];
                $selectedmenu[] = $menuitem;
            }
            
        }
        
        // render confirmation page
        render("confirm_order_form_user.php", ["selectedmenu" => $selectedmenu, "title" => "Confirm", "cost" => $cost], 1);
    }
    
    ?>
