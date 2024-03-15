<?php

require_once 'includes/dbh.inc.php';

$query = "SELECT C.DataComanda, F.Nume, P.NumeProdus, D.Cantitate, D.PretUnitar
          FROM Comenzi C LEFT JOIN Furnizori F ON C.FurnizorID = F.FurnizorID
                         LEFT JOIN DetaliiComenzi D ON C.ComandaID = D.ComandaID
                         LEFT JOIN Produse P ON P.ProdusID = D.ProdusID";
$stmt = $pdo->prepare($query);
$stmt->execute();