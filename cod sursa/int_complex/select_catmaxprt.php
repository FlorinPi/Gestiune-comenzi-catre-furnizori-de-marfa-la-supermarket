<?php

require_once 'includes/dbh.inc.php';

$query = "SELECT C.NumeCategorie, P.NumeProdus, P.Pret
          FROM CategoriiProduse C, Produse P
          WHERE P.Pret = (SELECT MAX(P2.Pret) FROM Produse P2 WHERE P2.CategorieID = C.CategorieID)
          ORDER BY P.Pret DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();