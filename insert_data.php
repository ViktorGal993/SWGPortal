<?php
include 'db_connection.php';
$name = "Иван";
$nachname ="Petrov";
$email = "ivan@example.com";
$sql = "INSERT INTO kunde (Vorname,Nachname, Email) VALUES ('$name','$nachname' '$email')";
if ($conn->query($sql) === TRUE) {   
     echo "Данные успешно сохранены!";
    } 
else { 
       echo "Ошибка: ".$conn->error;
    }
$conn->close();
?>