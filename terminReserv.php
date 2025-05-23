<?php
// Verbindung zur Datenbank
include 'db_connection.php';
// Abrufen von Daten aus Formular
$name = $_POST['name_termin'];
$lname = $_POST['nachname_termin'];
$email = $_POST['email_termin'];
$date = $_POST['date_termin'];
$time = $_POST['time_termin'];
$message =$_POST['termin_thema'];

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

//Email sendung
$vollname = $name . " " . $lname;
$subject = "Neue Termin-Anfrage über das SWG-Dienstleistungsportal.\n";
$admin_mail = "swg.passau@gmail.com";

    $email_content = "Name: $vollname,\r\n";
    $email_content .= "E-Mail: $email\r\n\n";
    $email_content .= "Date: $date\r\n";
    $email_content .= "Zeit:  $time\r\n";
    $email_content .= "Thema:  $message\r\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // E-Mail versenden
    $mail_sent = mail($admin_mail,$subject,$email_content, $headers);
    
     if ($mail_sent) {
        header("Location:index.php");
        /*
        echo "<p>Vielen Dank! Ihre Nachricht wurde erfolgreich gesendet.</p>";
        echo "<a href='index.php'>Zurückkehren</a>";
        */
    } else {
        echo "<p>Fehler beim Versenden der E-Mail.</p>";
        echo "<a href='index.php'>Zurückkehren</a>";
    }
        

    // Auto Antwort
    $subject_reply = "Vielen Dank für Ihre Termin-Anfrage.";
    $message_replay= "Unser Team wird sich zeitnah mit Ihnen in Verbindung setzen.";

     $mail_reply = mail($email,$subject_reply,$message_replay);




?>