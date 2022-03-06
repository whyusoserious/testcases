<?php
require_once 'initializeDB.php';

if ($conn->connect_error){
     die("Ошибка подключения: " . $conn->connect_error);
 }
 else{
     echo 'Успешное подключение!';
 }
   echo '<br>';
   $sql = "
           CREATE TABLE post (
               postId INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
               userId INT(10) UNSIGNED NOT NULL,
               title VARCHAR(255) NOT NULL,
               body VARCHAR(1000) NOT NULL
           );
           CREATE TABLE comment (
               idComm INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
               postId INT(7) UNSIGNED NOT NULL,
               name VARCHAR(255) NOT NULL,
               email VARCHAR(255) NOT NULL,
               body VARCHAR(500) NOT NULL,
               FOREIGN KEY (postId) REFERENCES post (postId)
           );";
  if (mysqli_multi_query($conn, $sql)){
       echo "Таблицы созданы успешно!";
   }
   else{
       echo "Ошибка создания таблиц: " . mysqli_error($conn);
   }

?>