<?php
    include 'mail.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {    

        $name = trim(htmlspecialchars(urldecode($_POST["name"] ?? "")));    
        
        $lname = trim(htmlspecialchars(urldecode($_POST["lname"] ?? "")));    
        
        $email = trim(htmlspecialchars(urldecode($_POST["email"] ?? "")));
         $to = "Viktorkauz@gmail.com"; // Укажите свою почту    
        
        $subject = "Brief von Seite";    
        
        $message = "Name: $name\nNachname: $lname\nEmail: $email";    
        
        $headers = "From: example2@mail.ru\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";
         if (mail($to, $subject, $message, $headers)) {       
        
         echo "Die Nachricht gesendet!";    
        
        } else {        
        
        echo "Fehler!";    }
    }

?>