<?php

require_once 'includes/dbh.inc.php';

$query = "SELECT * FROM Furnizori";
$stmt = $pdo->prepare($query);
$stmt->execute();
