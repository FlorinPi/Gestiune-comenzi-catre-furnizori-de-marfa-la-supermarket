<?php

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $nume = $_POST["numecat"];
    $desc = $_POST["desc"];


    require_once '../includes/config_session.inc.php';

    if(isset($_SESSION["admin_id"])){
        
        try {

            require_once '../includes/dbh.inc.php';

            $query = "INSERT INTO CategoriiProduse (NumeCategorie, Descriere) VALUES (:nume, :desc)";

            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":nume", $nume);
            $stmt->bindParam(":desc", $desc);

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