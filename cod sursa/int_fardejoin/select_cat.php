<?php

require_once 'includes/dbh.inc.php';

$query = "SELECT * FROM CategoriiProduse";
$stmt = $pdo->prepare($query);
$stmt->execute();