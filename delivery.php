<?
    session_start();
    require "functions.php";
    require_once("phpmailer/PHPMailerAutoload.php");
    
    $basket = $_SESSION["basket"];

    $count = count($basket);

    /* TODO: check amount and total payed using POST params*/
    $quantity = $_POST["quantity"];
    $total = $_POST["mc_gross"];
    $price = $_POST["item_number"];
    $to = $_POST["custom"];
    
    /* Store order in DB */
    $order = "";
    foreach ($basket as $key => $value) {
        $order = "{$order},{$key}";
    }
    
    $db = getDB();
    
    $newID = $db->insert("dejanOrder", [
    	"email" => $to,
    	"order" => $order
    ]);    

    $url = "http://www.dejan-photo.be/#bedankt.php?r={$newID}&e=" . urlencode($to);
    
/*    foreach($_POST as $key => $value) {
        echo $key . " => " . $value . "<br/>";
    }*/

    if ($count > 0 && $count == $quantity && $total == ($count * $price)) {
        $email = new PHPMailer();
        
        $email->setFrom("website@jan-en-ve.be");
        $email->addAddress($to);
        $email->addBCC("jan.dhollander+dejan@gmail.com");
        $email->Subject = "Uw bestelling bij DeJan Photography";
        $email->msgHTML("Bedankt voor uw bijdrage! <br/>Klik <a href='{$url}'>hier</a> om naar een pagina te gaan waar je je foto's kan downloaden.");
        
        if (!$email->send()) {
            $msg = "Mailer Error: " . $email->ErrorInfo;
            $msg = urlencode($msg);

            /* Redirect browser */
            header("Location: http://www.dejan-photo.be/#error.php?e={$msg}");
             
            /* Make sure that code below does not get executed when we redirect. */
            exit;
        } else {
            $msg = "Message sent!";

            $_SESSION["basket"] = array();
    
          /* Redirect browser */
            header("Location: {$url}");
             
            /* Make sure that code below does not get executed when we redirect. */
            exit;
        }
    } else {
        $msg = urlencode("Er ging iets mis met je bestelling! (ERROR {$count},{$quantity},{$total},{$price})");
        
        /* Redirect browser */
        header("Location: http://www.dejan-photo.be/#error.php?e={$msg}");
         
        /* Make sure that code below does not get executed when we redirect. */
        exit;
    }
?>