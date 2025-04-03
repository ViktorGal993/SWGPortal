<?php

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$mail = new PHPMailer(true);
try {    $mail->isSMTP(); 

$mail->Host       = 'smtp.gmail.com';    

$mail->SMTPAuth   = true;    

$mail->Username   = '**swg.passau@gmail.com**'; // Твой Gmail    

$mail->Password   = 'Qwerty321!';  // Используй App Password (см. ниже)    

$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    

$mail->Port       = 587;
$mail->setFrom('**swg.passau@gmail.com**', 'Support');    $mail->addAddress('viktorkauzg@gmail.com'); // Получатель
 $mail->Subject = 'Brief von Seite';    

$mail->Body    = "Name: {$_POST['name']}\nNachname: {$_POST['lname']}\nEmail: {$_POST['email']}";
 $mail->send();    echo "Die Nachricht wurde gesendet!";} catch (Exception $e) {    echo "Fehler: {$mail->ErrorInfo}";}
?>