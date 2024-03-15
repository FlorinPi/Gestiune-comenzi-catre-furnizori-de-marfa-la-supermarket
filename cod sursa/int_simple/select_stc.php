<?php

require_once 'includes/dbh.inc.php';

$query = "SELECT P.NumeProdus, S.Cantitate
          FROM Stocuri S LEFT JOIN Produse P ON P.ProdusID = S.ProdusID";
$stmt = $pdo->prepare($query);
$stmt->execute();