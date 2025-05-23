<?php
// Verbindung zur Datenbank
include 'db_connection.php';
// Abrufen von Daten aus Formular
$name = $_POST['name_ruckruf'];
$lname = $_POST['lname_ruckruf'];
$tel = $_POST['phone'];
$thema = $_POST['ruckruf_thema'];

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
$vollname = $name . " " . $lname;
$subject = "Neue Anfrage für einen Rückruf über das SWG-Dienstleistungsportal.\n";
$admin_mail = "swg.passau@gmail.com";

    $email_content = "Name: $vollname,\r\n"; 
    $email_content .= "Thema: $thema\r\n";      
    $email_content .= "Telefonnummer: $tel\r\n";
       

   
    $headers = "Content-Type: text/plain; charset=UTF-8\r\n";

    // E-Mail versenden
    $mail_sent = mail($admin_mail,$subject,$email_content, $headers);

     if ($mail_sent) {
        //zuruck zu Hauptseite    
         header("Location:index.php");
    } else {
        echo "<p>Fehler beim Versenden der E-Mail.</p>";
      }


?>