<?php

require_once 'includes/dbh.inc.php';

$query = "SELECT P.NumeProdus, P.Pret, C.NumeCategorie, F.Nume
          FROM Produse P LEFT JOIN CategoriiProduse C ON P.CategorieID = C.CategorieID
                         LEFT JOIN Furnizori F ON P.FurnizorID = F.FurnizorID";
$stmt = $pdo->prepare($query);
$stmt->execute();