<?php
// Verbindung zur Datenbank
include 'db_connection.php';
// Abrufen von Daten aus Formular
$name = $_POST['name_support'];
$lname = $_POST['lname_support'];
$email = $_POST['email_support'];
$message = $_POST['message_support'];
if ($name && $email && $lname && $message) { 
       try {        
        // Autocommit ausschalten       
        $conn->begin_transaction();
        // Daten in die erste Tabelle einfügen       
        $sql1 = "INSERT INTO kunde(Vorname, Nachname, Email) VALUES (?,?,?)";        
        $stmt1 = $conn->prepare($sql1);        
        $stmt1->bind_param("sss", $name, $lname, $email);        
        $stmt1->execute();
        // Abrufen der ID des zuletzt eingefügten Eintrags       
        $userId = $conn->insert_id;
        // Daten in die zweite Tabelle einfügen       
        $sql2 = "INSERT INTO anfrage (Kunde_ID, Beschreibung) VALUES (?, ?)";        
        $stmt2 = $conn->prepare($sql2);        
        $stmt2->bind_param("is", $userId, $message);        
        $stmt2->execute();
        // Transaktion bestätigen      
        $conn->commit();        
        echo "Die Daten wurden erfolgreich gespeichert!"; 
        echo "<br> <a href='index.php'>Zurückkehren</a>";   
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

?>



