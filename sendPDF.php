<?php
//Sendung Von Bewerbungsunterlagen per E-mail

if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === 0) {  

    $to = "swg.passau@gmail.com";    
    $subject = "Neue Bewerbung";    
    $message = "Neue Bewerbungsunterlagen von SWG IT-Dienstleistungsportal";    
    
//Pdf File herunterladen
    $filename = $_FILES['pdf_file']['name'];    
    $file = $_FILES['pdf_file']['tmp_name']; 
    //ablesunf   
    $file_data = file_get_contents($file); 
    //kodierung in base64   
    $encoded_content = chunk_split(base64_encode($file_data)); 
    //verteilun von Telen des Brifs (text + unterlagen)   
    $boundary = md5("simple_boundary");

//header 
    $headers = "MIME-Version: 1.0\r\n";    
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
//text
    $body = "--$boundary\r\n";    
    $body .= "Content-Type: text/plain; charset=\"utf-8\"\r\n\r\n";    
    $body .= "$message\r\n";    
//unterlagen
    $body .= "--$boundary\r\n";    
    $body .= "Content-Type: application/pdf; name=\"$filename\"\r\n";    
    $body .= "Content-Transfer-Encoding: base64\r\n";    
    $body .= "Content-Disposition: attachment; filename=\"$filename\"\r\n\r\n";    
    $body .= "$encoded_content\r\n";    
    $body .= "--$boundary--";
//sendung
    if (mail($to, $subject, $body, $headers)) {        
        echo "Die Nachricht wurde gesendet!";    } 
        else {        
            echo "Fehler beim Senden.";    }
        } else {    
            echo "Die Datei wurde nicht hochgeladen.";
        }

?>