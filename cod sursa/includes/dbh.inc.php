<?php

$serverName = "DESKTOP-UFESM0S\SQLEXPRESS";
$dbname = "ProiectBD";
$dbusername = "";
$dbpassword = "";

try {  
    $pdo = new PDO( "sqlsrv:server=$serverName;Database = $dbname", $dbusername, $dbpassword);   
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );   
 }  

 catch( PDOException $e ) {  
    die("Connection failed: " . $e->getMessage());
 }  