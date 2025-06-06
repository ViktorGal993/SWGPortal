<?php
// Verbindung zur Datenbank
include 'db_connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//  Composer herunterladen
require 'vendor/autoload.php';
// herunterladen .env
$env = parse_ini_file(__DIR__ . '/.env');
foreach ($env as $key => $value) {   
     putenv("$key=$value");
    }
// Abrufen von Daten aus Formular
$name = $_POST['name_termin'];
$lname = $_POST['nachname_termin'];
$email = $_POST['email_termin'];
$date = $_POST['date_termin'];
$time = $_POST['time_termin'];
$message =$_POST['termin_thema'];
$vollname = $name . " " . $lname;

if ($name && $email && $lname && $date &&$time) { 
       try {        
        // Autocommit ausschalten       
        $conn->begin_transaction();
        // Daten in die erste Tabelle einfügen       
        $sql3 = "INSERT INTO kunde(Vorname, Nachname, Email) VALUES (?,?,?)";        
        $stmt3 = $conn->prepare($sql3);        
        $stmt3->bind_param("sss", $name, $lname, $email);        
        $stmt3->execute();
        // Abrufen der ID des zuletzt eingefügten Eintrags       
        $userId = $conn->insert_id;
        // Daten in die zweite Tabelle einfügen       
        $sql4 = "INSERT INTO termin (Kunde_ID, Datum, Uhrzeit, Thema) VALUES (?, ?,?,?)";        
        $stmt4 = $conn->prepare($sql4);        
        $stmt4->bind_param("isss", $userId, $date, $time, $message);        
        $stmt4->execute();
        // Transaktion bestätigen      
        $conn->commit();        
        echo " ";   
        } 
        catch (Exception $e) {        
            // zurücksetzen beim Fehler      
            $conn->rollback();        
            echo "„Fehler beim Einfügen ".$e->getMessage();    
            } 
        finally {        
                // Verbindung schließen        
                $stmt3->close();        
                $stmt4->close();        
                $conn->close();    
                }
            } 
            else {    
                    echo "Alle Felder müssen ausgefüllt werden";
                }

// Дата и время
$start = date('Ymd\THis', strtotime("$date $time"));
$end = date('Ymd\THis', strtotime("$date $time +60 minutes"));
$summary = "Termin für:  $name $lname";

// ICS-контент
$uid = uniqid();
$ics = "BEGIN:VCALENDAR\r\n";
$ics .= "VERSION:2.0\r\n";
$ics .= "PRODID:-//TerminSystem//EN\r\n";
$ics .= "CALSCALE:GREGORIAN\r\n";
$ics .= "METHOD:REQUEST\r\n";
$ics .= "BEGIN:VEVENT\r\n";
$ics .= "UID:" . uniqid() . "@gmail.com\r\n";
$ics .= "DTSTAMP:" . date('Ymd\THis') . "\r\n";
$ics .= "DTSTART;TZID=Europe/Berlin:$start\r\n";
$ics .= "DTEND;TZID=Europe/Berlin:$end\r\n";
$ics .= "SUMMARY:$summary\r\n";
$ics .= "DESCRIPTION:Über SWG Portal. Email: $email\r\n";
$ics .= "STATUS:CONFIRMED\r\n";
$ics .= "END:VEVENT\r\n";
$ics .= "END:VCALENDAR\r\n";

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
    $mailAdmin->Subject = 'Neue Termin-Anfrage von das SWG-Dienstleistungsportal';    
    $mailAdmin->Body = "      <b>Name:</b> {$vollname}<br>      <b>Email:</b> {$email}<br> <pre></pre> <b>Date: </b> {$date}  <b>Time:</b>  {$time}</pre><br>   <b>Nachricht:</b><br>" . nl2br($message);  
    $mailAdmin->addStringAttachment($ics, 'termin.ics', 'base64', 'text/calendar; method=REQUEST; charset=UTF-8'); 
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
    $autoReply->Body = "        <p>Hallo, <b>{$name}</b>! Vielen Dank für Ihre Termin-Anfrage.<br>Unser Team wird sich zeitnah mit Ihnen in Verbindung setzen. </p> "; 
    
    $autoReply->send();
    header("Location:index.php");} 

   catch (Exception $e) {    
        error_log("Fehler: " . $e->getMessage());    
        echo 'Fehler beim Versenden der E-Mail.';}

?>