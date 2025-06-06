<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//  Composer herunterladen
require 'vendor/autoload.php';
// herunterladen .env
$env = parse_ini_file(__DIR__ . '/.env');
foreach ($env as $key => $value) {   
     putenv("$key=$value");
    }

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
$mailAdmin = new PHPMailer(true);
try {    
    $mailAdmin->isSMTP();    
    $mailAdmin->Host = 'smtp.strato.de';    
    $mailAdmin->SMTPAuth = true;    
    $mailAdmin->Username = getenv('SMTP_USER');    
    $mailAdmin->Password = getenv('SMTP_PASS');    
    $mailAdmin->SMTPSecure = 'ssl';    
    $mailAdmin->Port = 465;
    $mailAdmin->setFrom(getenv('SMTP_USER'), 'SWG-Portal');    
    $mailAdmin->addAddress(getenv('ADMIN'), 'Admin');
    $mailAdmin->isHTML(true);    
    $mailAdmin->Subject = 'Neue Bewerbungsunterlagen von SWG IT-Dienstleistungsportal';    
    $mailAdmin->Body = "<b>Bewerbungsnachricht:</b><br>" . nl2br($bewerb_message); 
    //PDF file 
    $mailAdmin->addAttachment($uploadFile, 'Bewerbungsunterlagen.pdf'); 
    //$mailAdmin->AltBody = "Name: $name\nEmail: $email\nnachricht:\n$message";
    $mailAdmin->send();
   
    header("Location:index.php");} 

   catch (Exception $e) {    
        error_log("Fehler: " . $e->getMessage());    
        echo 'Fehler beim Versenden der E-Mail.';}


?>

