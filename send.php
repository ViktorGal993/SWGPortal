<?php

$name = $_POST['name'];
$lname = $_POST['lname'];
$email = $_POST['email'];

$name = htmlspecialchars($name);
$lname = htmlspecialchars($lname);
$email = htmlspecialchars($email);

# decodierung url
$name = urldecode($name);
$lname = urldecode($lname);
$email = urldecode($email);

#delete von probelen
$name = trim($name);
$lname = trim($lname);
$email = trim($email);


echo $name, " | ", $lname, " | ", $email;

# send of message
mail("viktorkauzg@gmail.com", "Brief von Seite", "Name: ".$name. "Nachname:".$lname." . Email: ".$email, "From: example2@mail.ru\r\n");

# Prufung
if(mail("viktorkauzg@gmail.com", "Brief von Seite", "Name: ".$name. "Nachname:".$lname." . Email: ".$email, "From: example2@mail.ru\r\n"))
{
    echo " die Nachrichr gesendet";
}
else {
    echo "Fehler";
}

?>