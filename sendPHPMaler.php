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
// Formulardaten empfangen
$name = $_POST['name_support'];
$lname = $_POST['lname_support'];
$email = $_POST['email_support'];
$message = $_POST['message_support'];
$vollname = $name . " " . $lname;
$subject = "Neue Anfrage von SWG IT-Dienstleistungsportal";


// Ein E-mail an Administrator
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
    $mailAdmin->Subject = 'Neue Anfrage von SWG IT-Dienstleistungsportal';    
    $mailAdmin->Body = "        <b>Name:</b> {$vollname}<br>        <b>Email:</b> {$email}<br>        <b>Nachricht:</b><br>" . nl2br($message);    
    $mailAdmin->AltBody = "Name: $name\nEmail: $email\nnachricht:\n$message";
    $mailAdmin->send();

    // Autoantwort  
    $autoReply = new PHPMailer(true);    
    $autoReply->isSMTP();    
    $autoReply->Host = 'smtp.strato.de';    
    $autoReply->SMTPAuth = true;    
    $autoReply->Username = getenv('SMTP_USER');    
    $autoReply->Password = getenv('SMTP_PASS');    
    $autoReply->SMTPSecure = 'ssl';    
    $autoReply->Port = 465;
    $autoReply->setFrom(getenv('SMTP_USER'), 'SWG-Portal');    
    $autoReply->addAddress($email, $name);
    $autoReply->isHTML(true);    
    $autoReply->Subject = 'Vielen Dank! Ihre Nachricht wurde erfolgreich gesendet.';    
    $autoReply->Body = "        <p>Hallo, <b>{$name}</b>! Vielen Dank! Ihre Nachricht wurde erfolgreich gesendet. </p> "; 
    
    $autoReply->send();
    header("Location:index.php");} 

   catch (Exception $e) {    
        error_log("Fehler: " . $e->getMessage());    
        echo 'Fehler beim Versenden der E-Mail.';}
        

        
?>