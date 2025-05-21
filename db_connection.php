<?php
$host = 'localhost'; // Хост
$user = 'root';      // Имя пользователя MySQL
$password = '';      // Пароль (по умолчанию пустой в XAMPP)
$dbname = 'itdp';   // Имя базы данных
 // Создание подключения
$conn = new mysqli($host, $user, $password, $dbname);
// Проверка подключения
if ($conn->connect_error) {    
   die("Ошибка подключения: ".$conn->connect_error);
} 
   else {    
      echo "";
   }

?>