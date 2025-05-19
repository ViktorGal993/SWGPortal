<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';
$mail = new PHPMailer(true);
try {   
     // Настройки сервера    
     $mail->isSMTP();    
     $mail->Host = 'smtp.office365.com';    
     $mail->SMTPAuth = true;    
     $mail->Username = 'swg.passau@outlook.de';    
     $mail->Password = 'Qwerty321!!!';    
     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    
     $mail->Port = 587;
    // Настройки письма    
    $mail->setFrom('swg.passau@outlook.de', 'SWG-Portal');    
    $mail->addAddress('viktorkauzg@gmail.com', 'Viktor');    
    $mail->isHTML(true);    
    $mail->Subject = 'Test-E-Mail';    
    $mail->Body = 'Dies ist eine Test-E-Mail mit PHPMailer.';
    // Отправка письма    
    $mail->send();    
    echo 'Nachricht erfolgreich gesendet';
} catch (Exception $e) 
{    
    echo "Fehler bei der Sendung:".$mail->ErrorInfo;    
    error_log($mail->ErrorInfo, 3, __DIR__ . '/error.log');
}

?>