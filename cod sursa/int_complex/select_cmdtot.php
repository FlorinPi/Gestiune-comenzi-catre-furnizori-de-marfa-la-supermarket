<?php

require_once 'includes/dbh.inc.php';

$query = "SELECT F.Nume,
          (SELECT SUM(D.Cantitate) FROM DetaliiComenzi D WHERE D.ComandaID IN 
            (SELECT C.ComandaID FROM Comenzi C WHERE C.FurnizorID = F.FurnizorID)) AS TotalCantitate
          FROM Furnizori F";
$stmt = $pdo->prepare($query);
$stmt->execute();