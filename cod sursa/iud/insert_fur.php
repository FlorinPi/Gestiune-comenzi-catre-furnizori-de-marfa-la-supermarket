<?php

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $nume = $_POST["nume"];
    $strada = $_POST["strada"];
    $nr = $_POST["nr"];
    $localitate = $_POST["localitate"];
    $telefon = $_POST["telefon"];
    $email = $_POST["email"];

    require_once '../includes/config_session.inc.php';

    if(isset($_SESSION["admin_id"])){
        
        try {

            require_once '../includes/dbh.inc.php';

            $query = "INSERT INTO Furnizori (Nume, Strada, Nr, Localitate, Telefon, Email) VALUES (:nume, :strada, :nr, :localitate, :telefon, :email)";

            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":nume", $nume);
            $stmt->bindParam(":strada", $strada);
            $stmt->bindParam(":nr", $nr);
            $stmt->bindParam(":localitate", $localitate);
            $stmt->bindParam(":telefon", $telefon);
            $stmt->bindParam(":email", $email);

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