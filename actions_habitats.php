<?php
require_once("connect.php");

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['ajouter'])) {
            $nouveau_nom = $_POST['nouveau_nom'];
            $nouvelle_description = $_POST['nouvelle_description'];
            $nouveau_commentaire = $_POST['nouveau_commentaire'];

            $sql = "INSERT INTO habitat (name, description, commentary) VALUES (:name, :description, :commentary)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $nouveau_nom, PDO::PARAM_STR);
            $stmt->bindParam(':description', $nouvelle_description, PDO::PARAM_STR);
            $stmt->bindParam(':commentary', $nouveau_commentaire, PDO::PARAM_STR);
            $stmt->execute();

            $habitat_id = $pdo->lastInsertId();

            if (isset($_FILES['nouvelle_image']) && $_FILES['nouvelle_image']['error'] == 0) {
                $image_path = 'uploads/' . basename($_FILES['nouvelle_image']['name']);
                move_uploaded_file($_FILES['nouvelle_image']['tmp_name'], $image_path);

                $sql = "INSERT INTO image (habitat_id, image_path) VALUES (:habitat_id, :image_path)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
                $stmt->bindParam(':image_path', $image_path, PDO::PARAM_STR);
                $stmt->execute();
            }

        } elseif (isset($_POST['modifier'])) {
            $habitat_id = $_POST['habitat_id'];
            $habitat_nom = $_POST['habitat_nom'];
            $habitat_description = $_POST['habitat_description'];
            $habitat_commentary = $_POST['habitat_commentary'];

            $sql = "UPDATE habitat SET name = :name, description = :description, commentary = :commentary WHERE habitat_id = :habitat_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $habitat_nom, PDO::PARAM_STR);
            $stmt->bindParam(':description', $habitat_description, PDO::PARAM_STR);
            $stmt->bindParam(':commentary', $habitat_commentary, PDO::PARAM_STR);
            $stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
            $stmt->execute();

            if (isset($_FILES['habitat_image']) && $_FILES['habitat_image']['error'] == 0) {
                $image_path = 'uploads/' . basename($_FILES['habitat_image']['name']);
                move_uploaded_file($_FILES['habitat_image']['tmp_name'], $image_path);

                $sql = "REPLACE INTO image (habitat_id, image_path) VALUES (:habitat_id, :image_path)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
                $stmt->bindParam(':image_path', $image_path, PDO::PARAM_STR);
                $stmt->execute();
            }

        } elseif (isset($_POST['supprimer'])) {
            $habitat_id = $_POST['habitat_id'];

            $sql = "DELETE FROM image WHERE habitat_id = :habitat_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
            $stmt->execute();

            $sql = "DELETE FROM habitat WHERE habitat_id = :habitat_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    header("Location: gerer_habitats.php");
    exit();

} catch (PDOException $e) {
    echo "Erreur de base de données : " . $e->getMessage();
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}

$pdo = null;