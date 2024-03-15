<?php
require_once '../includes/dbh.inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $localitate = $_POST["localitate"];

    try {
        $query = "SELECT F.Nume, COUNT(P.ProdusID) AS NrProduse
                    FROM Furnizori F 
                    LEFT JOIN Produse P ON P.FurnizorID = F.FurnizorID
                    WHERE F.Localitate = :localitate
                    GROUP BY F.Nume
                    HAVING COUNT(P.ProdusID) >= 1";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":localitate", $localitate);
        $stmt->execute();

        // Display the table here
        echo "<table border='1'>";
        echo "<tr>
                <td>Furnizor</td>
                <td>Numar Produse</td>
              </tr>";

        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$rows['Nume']}</td>
                    <td>{$rows['NrProduse']}</td>
                  </tr>";
        }

        echo "</table>";

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
?>
