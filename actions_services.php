<?php

require_once("connect.php");

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Traitement des actions sur les service
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['modifier'])) {
        // Traitement de la modification du service
        $service_id = $_POST['service_id'];
        $service_nom = $_POST['service_nom'];
        $service_description = $_POST['service_description'];

        try {
            $sql = "UPDATE service SET name = :name, description = :description WHERE service_id = :service_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $service_nom, PDO::PARAM_STR);
            $stmt->bindParam(':description', $service_description, PDO::PARAM_STR);
            $stmt->bindParam(':service_id', $service_id, PDO::PARAM_INT);
            $stmt->execute();
            header("location: edit-services.php");
        } catch (PDOException $e) {
            echo "Erreur lors de la modification du service : " . $e->getMessage();
        }
    } elseif (isset($_POST['supprimer'])) {
        // Traitement de la suppression du service
        $service_id = $_POST['service_id'];

        try {
            $sql = "DELETE FROM service WHERE service_id = :service_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':service_id', $service_id, PDO::PARAM_INT);
            $stmt->execute();
            header("location: edit-services.php");
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression du service : " . $e->getMessage();
        }
    } elseif (isset($_POST['ajouter'])) {
        // Traitement de l'ajout d'un nouveau service
        $nouveau_service_nom = $_POST['nouveau_service_nom'];
        $nouveau_service_description = $_POST['nouveau_service_description'];
        header("location: edit-services.php");

        try {
            $sql = "INSERT INTO service (name, description) VALUES (:name, :description)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $nouveau_service_nom, PDO::PARAM_STR);
            $stmt->bindParam(':description', $nouveau_service_description, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout du service : " . $e->getMessage();
        }
    }
}

// Fermer la connexion à la base de données
$pdo = null;

