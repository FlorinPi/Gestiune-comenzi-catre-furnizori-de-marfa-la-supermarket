<?php

require_once 'includes/dbh.inc.php';

$query = "SELECT DISTINCT C.DataComanda, P.NumeProdus, D.Cantitate
          FROM DetaliiComenzi D LEFT JOIN Comenzi C ON C.ComandaID = D.ComandaID
                                LEFT JOIN Produse P ON P.ProdusID = D.ProdusID
          WHERE C.DataComanda > '2024-01-01'
          ORDER BY C.DataComanda";
$stmt = $pdo->prepare($query);
$stmt->execute();