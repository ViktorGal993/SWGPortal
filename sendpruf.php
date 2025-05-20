<?php   

$server = "smtp.gmail.com";
$port = 587;
$connection = fsockopen($server, $port, $errno, $errstr, 10);
if (!$connection) {    echo "Ошибка соединения: $errstr ($errno)";} else {    echo "Соединение установлено!";    fclose($connection);}
?>