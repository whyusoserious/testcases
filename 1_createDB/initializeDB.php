<?php
$server = 'localhost';
$login = 'mysql';
$pass = '';
//$dbname="commentDB";

//$conn = new mysqli($server, $login, $pass, $dbname);

 $conn = new mysqli($server, $login, $pass);

 if ($conn->connect_error){
     die("Ошибка подключения: " . $conn->connect_error);
 }
 else{
     echo 'Успешное подключение!';
 }

 echo "<br>";

 $sql = "CREATE DATABASE commentDB";

if($conn->query($sql) === TRUE) {
     echo "БД создана успешно!";
 }
 else{
     echo "Ошибка при создании ДБ" . $conn->error;
 }

//$conn->close();