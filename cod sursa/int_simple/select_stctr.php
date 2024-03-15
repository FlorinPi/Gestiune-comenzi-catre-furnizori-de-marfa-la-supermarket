<?php

require_once 'includes/dbh.inc.php';

$query = "SELECT P.NumeProdus, S.Cantitate
          FROM Stocuri S RIGHT JOIN Produse P ON P.ProdusID = S.ProdusID
          WHERE S.Cantitate <= 100
          ORDER BY S.Cantitate DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();