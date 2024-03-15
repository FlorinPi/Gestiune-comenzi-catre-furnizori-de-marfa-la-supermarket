<?php

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $nume = $_POST["numecat"];
    $nou = $_POST["nou"];


    require_once '../includes/config_session.inc.php';

    if(isset($_SESSION["admin_id"])){
        
        try {

            require_once '../includes/dbh.inc.php';

            $query = "UPDATE CategoriiProduse SET NumeCategorie = :nou WHERE NumeCategorie = :nume";

            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":nume", $nume);
            $stmt->bindParam(":nou", $nou);

            $stmt->execute();

            $pdo = null;
            $stmt = null;

            header("Location: ../db.php");

            die();
            
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }

    }
    else {
        header("Location: ../index.php");
        die();
    }

}
else {
    header("Location: ../index.php");
    die();
}