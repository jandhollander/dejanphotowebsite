<?
    $name = $_POST["name"];
    $email = $_POST["email"];
    $msg = $_POST["message"];
    
    $msg = "Email gestuurd door {$name} ({$email}) \r\n\r\n{$msg}";
    
    $headers = "From: website@dejan-photo.be\r\n";
    
    $success = mail("jan.dhollander+dejan@gmail.com", "Email via DeJan website", $msg, $headers);
    
    echo "Email sent: {$success}";
?>
