<?php

require_once 'includes/dbh.inc.php';

$query = "SELECT F.Nume, (SELECT SUM(P.Pret) FROM Produse P WHERE P.FurnizorID = F.FurnizorID) AS TotalPret FROM Furnizori F;";
$stmt = $pdo->prepare($query);
$stmt->execute();