<?php
    
    // configuration
    require("../includes/config.php");
    require("../includes/class.phpmailer.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // retrieve order being updated
        $result = query("SELECT * FROM pending_order WHERE id = ?", $_POST["uniqueid"]);
        
        // only one row
        $order = $result[0];
        
        // access serialized food list, price list, and quantity list
        $foods = unserialize($order["foods"]);
        
        // update cost for possible new quantities
        $cost = 0;
        
        foreach ($foods["food"] as $key => $food)
        {
            // str_replace is used as a PHP key can't have spaces
            $foods["quantity"][$key] = $_POST[str_replace(" ", "_", $food)];
            $cost = $cost + $foods["quantity"][$key] * $foods["price"][$key];
        }
        
        // this string holds the status that will be emailed at the end of page
        $status_text = "";
        
        // update pressed
        if($_POST["action"] == 1)
        {
            // serialize new foods data
            $updated_foods_serialized = serialize($foods);
            
            // update food for id
            query("UPDATE pending_order SET id = ?, name = ?, email = ?, mobilenumber = ?, dorm = ?, foods = ?, status = ?, cost = ? WHERE id = ?", $_POST["id"], $_POST["name"], $_POST["email"], $_POST["mobilenumber"], $_POST["dorm"], $updated_foods_serialized, $_POST["status"], $cost, $_POST["uniqueid"]);
            
            // update status text
            if ($_POST["status"] != $_POST["originalstatus"])
            {
                
                switch ($_POST["status"])
                {
                    case 0:
                        $status_text = "Unconfirmed";
                        break;
                    case 1:
                        $status_text = "At Restaurant";
                        break;
                    case 2:
                        $status_text = "En Route";
                        break;
                }
            }
            
        }
        
        // delete pressed
        else if ($_POST["action"] == 0)
        {
            query("DELETE FROM pending_order WHERE id = ? ", $_POST["uniqueid"]);
            
            // update status text
            $status_text = "Deleted";
            
        }
        
        // completed pressed
        else if ($_POST["action"] == 2)
        {
            // serialize new foods data
            $updated_foods_serialized = serialize($foods);
            
            // add to completed_trable
            $results = query("INSERT INTO completed_order (id, name, email, mobilenumber, dorm, foods, cost, id_restaurant, id_user, username, datetime, name_restaurant) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $_POST["id"], $_POST["name"], $_POST["email"], $_POST["mobilenumber"], $_POST["dorm"], $updated_foods_serialized,  $cost, $order["id_restaurant"], $order["id_user"], $order["username"], $order["datetime"], $order["name_restaurant"]);
            
            // delete from pending_order
            query("DELETE FROM pending_order WHERE id = ? ", $_POST["uniqueid"]);
            
            // update status text
            $status_text = "Delivered";
  
        }
        
        // only send an email if the status has changed
        if(!empty($status_text))
        {
            // send email notification to customer & deliverer
            $mail = new PHPMailer();
            
            $mail->IsSMTP();
            $mail->Host = "localhost";
            $mail->SMTPAuth = true;
            $mail->Username = "instanomz13";
            $mail->Password = "f*GwzyDK";
            
            $mail->From = "donotreply@instanomz.com";
            $mail->FromName = "InstaNomz Team";
            
            $mail->AddAddress($_POST["email"], $_POST["name"]);
            $mail->AddAddress("orders@instanomz.com", "InstaNomz Delivery");
            $mail->AddCC("8572778590@tmomail.net");
            
            $mail->AddReplyTo("akshar.bonu@gmail.com", "Akshar Bonu");
            
            $mail->WordWrap = 50;
            $mail->IsHTML(true);
            
            $mail->Subject = sprintf("Order Status: %s", $status_text);
            
            $body = sprintf("The date and time of your order is: %s<br/><br/>", date("n/j/y, g:ia", strtotime($order["datetime"])));
            foreach ($foods["food"] as $key => $food)
            {
                $body = $body . sprintf("%s %s at $%s each<br/>", $foods["quantity"][$key], $food, $foods["price"][$key]);
            }
            
            $body = $body . sprintf("<br/>The total cost is: $%s<br/><br/>The Order Status is: %s<br/><br/>The Order Id is: %s<br/><br/>The delivery location is: %s<br/><br/>", number_format($cost, 2), htmlspecialchars($status_text), htmlspecialchars($_POST["uniqueid"]), htmlspecialchars($order["dorm"]));
            
            $mail->Body = $body;
            
            if(!$mail->Send())
            {
                echo "Message could not be sent. <p>";
                echo "Mailer Error: " . $mail->ErrorInfo;
                exit;
            }
        }
        
        redirect("index_admin.php");
    }
    
?>
