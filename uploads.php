<?php

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
                        echo "Datei erfolgreich hochgeladen!";        
                        
                        echo "<br> <a href='index.php'>Zurückkehren</a>";       
                } 
                else {            
                        echo "Datei nicht hochgeladen.";
                        echo "<br> <a  href='index.php'>Zurückkehren</a>";     
                }   
        } 
       
}

?>