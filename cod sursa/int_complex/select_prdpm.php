<?php

require_once '../includes/dbh.inc.php';

// Check if the price parameters are provided
if (isset($_POST['minPrice']) && isset($_POST['maxPrice'])) {
    $minPrice = $_POST['minPrice'];
    $maxPrice = $_POST['maxPrice'];

    $query = "SELECT P.NumeProdus, P.Pret
              FROM Produse P
              WHERE P.Pret IN (SELECT P2.Pret FROM Produse P2 WHERE P2.Pret BETWEEN :minPrice AND :maxPrice)
              ORDER BY P.PRET DESC";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":minPrice", $minPrice);
    $stmt->bindParam(":maxPrice", $maxPrice);
    $stmt->execute();

    echo "<table border='1'>";
    echo "<tr>
            <td>Nume Produs</td>
            <td>Pret</td>
          </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$row['NumeProdus']}</td>
                <td>{$row['Pret']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "Invalid parameters.";
}
