<?php
$servername = "localhost";

try {
   $conn = new PDO("mysql:host=$servername;dbname=onlinetest;charset=utf8", "root", "");
   // set the PDO error mode to exception
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
catch(PDOException $e)
   {
   echo "Connection failed: " . $e->getMessage();
   }
?>
