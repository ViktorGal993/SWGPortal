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
// Verbindung zur Datenbank
include 'db_connection.php';
// Abrufen von Daten aus Formular
$name = $_POST['name_ruckruf'];
$lname = $_POST['lname_ruckruf'];
$tel = $_POST['phone'];
$thema = $_POST['ruckruf_thema'];
$vollname = $name . " " . $lname;

if ($name && $lname && $tel) { 
       try {        
        // Autocommit ausschalten       
        $conn->begin_transaction();
        // Daten in die erste Tabelle einfügen       
        $sql1 = "INSERT INTO kunde(Vorname, Nachname,Telefonnummer) VALUES (?,?,?)";        
        $stmt1 = $conn->prepare($sql1);        
        $stmt1->bind_param("sss", $name, $lname,$tel);        
        $stmt1->execute();
        // Abrufen der ID des zuletzt eingefügten Eintrags       
        $userId = $conn->insert_id;
        // Daten in die zweite Tabelle einfügen       
        $sql2 = "INSERT INTO ruckruf (Kunde_ID,Thema) VALUES (?,?)";        
        $stmt2 = $conn->prepare($sql2);        
        $stmt2->bind_param("is", $userId, $thema);        
        $stmt2->execute();
        // Transaktion bestätigen      
        $conn->commit();  
          
         
        } 
        catch (Exception $e) {        
            // zurücksetzen beim Fehler      
            $conn->rollback();        
            echo "„Fehler beim Einfügen ".$e->getMessage();    
            } 
        finally {        
                // Verbindung schließen        
                $stmt1->close();        
                $stmt2->close();        
                $conn->close();    
                }
            } 
            else {    
                    echo "Alle Felder müssen ausgefüllt werden";
                    echo "<br> <a href='index.php'>Zurückkehren</a>";  
                }

//Email sendung
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
    $mailAdmin->Subject = 'Neue Ruckrufanfrage von das SWG-Dienstleistungsportal.';    
    $mailAdmin->Body = "      <b>Name:</b> {$vollname}<br>      <b>Telefonnummer:</b> {$tel}<br> <b>Thema:<br> </b> {$thema}<br>";     
   // $mailAdmin->AltBody = "Name: $name\nEmail: $email\nnachricht:\n$message";
    $mailAdmin->send();
    echo"<script>window.location.href='http://service.swg-datensysteme.de/'</script>";

    header("Location:index.php");} 

   catch (Exception $e) {    
        error_log("Fehler: " . $e->getMessage());    
        echo 'Fehler beim Versenden der E-Mail.';}

?>