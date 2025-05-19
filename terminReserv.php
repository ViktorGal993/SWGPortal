<?php
// Verbindung zur Datenbank
include 'db_connection.php';
// Abrufen von Daten aus Formular
$name = $_POST['name_termin'];
$lname = $_POST['nachname_termin'];
$email = $_POST['email_termin'];
$date = $_POST['date_termin'];
$time = $_POST['time_termin'];
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
        $sql4 = "INSERT INTO termin (Kunde_ID, Datum, Uhrzeit) VALUES (?, ?,?)";        
        $stmt4 = $conn->prepare($sql4);        
        $stmt4->bind_param("iss", $userId, $date, $time);        
        $stmt4->execute();
        // Transaktion bestätigen      
        $conn->commit();        
        echo "Die Daten wurden erfolgreich gespeichert!"; 
        echo " <a href='index.php'>Zurückkehren</a>";   
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

?>