<?php
  $host = "localhost";
  $user = "root";
  $pass = "************";
  $db = "id19008650_database";

$conn = mysqli_connect($host, $user, $pass, $db);

if($conn === false){
    die("ERREUR : N'a pas pu se connecter." . mysqli_connect_error());
}

?>