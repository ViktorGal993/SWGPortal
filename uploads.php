<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
        if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] == UPLOAD_ERR_OK) {        

                $uploadDir = __DIR__ . '/scr/uploads/';
                $uploadFile = $uploadDir.basename($_FILES['pdf_file']['name']);

                // überprüfung des format        
                $fileType = mime_content_type($_FILES['pdf_file']['tmp_name']);   

                if ($fileType != 'application/pdf') {            
                        echo "Fehler: Nur PDF-Dateien sind erlaubt.";            
                        exit; 
                }
                // Перемещение файла       
                if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], $uploadFile)) { 
                      /*  echo "Datei erfolgreich hochgeladen, ";     */
                } 
                else {            
                        echo "Datei nicht hochgeladen.";
                            
                }   
        } 
       
}

$bewerb_message = $_POST['bewerb_message'];
//Sendung Von Bewerbungsunterlagen per E-mail
if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === 0) { 
    $to = "swg.passau@gmail.com";    
    $subject = "Neue Bewerbung";    
    $message = "Neue Bewerbungsunterlagen von SWG IT-Dienstleistungsportal"; 
    $nachricht = "Bewerbungsnachricht:\r\n$bewerb_message";     
    
    //ablesung  
    $file_data = file_get_contents($uploadFile); 
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
    $body .= "$message\r\n\r\n";      
    $body .= "$nachricht\r\n";
//unterlagen
    $body .= "--$boundary\r\n";    
    $body .= "Content-Type: application/pdf; name=\"$uploadFile\"\r\n";    
    $body .= "Content-Transfer-Encoding: base64\r\n";    
    $body .= "Content-Disposition: attachment; filename=\"$uploadFile\"\r\n\r\n";    
    $body .= "$encoded_content\r\n";    
    $body .= "--$boundary--";
//sendung
    if (mail($to, $subject, $body, $headers)) {        
         header("Location:index.php");

        } 
        else {        
            echo "Fehler beim Senden.";   
            echo "<br> <a  href='index.php'>Zurückkehren</a>"; 
        }
        } else {    
            echo "Die Datei wurde nicht hochgeladen.";
            echo "<br> <a  href='index.php'>Zurückkehren</a>"; 
        }
            

?>

