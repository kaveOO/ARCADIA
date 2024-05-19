<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <?php

        require_once("connect.php");

        try {
            $sql = "SELECT service_id, name, description FROM service";
             $stmt = $pdo->query($sql);
    
            if ($stmt->rowCount() > 0) {
                // Afficher les services existants avec la possibilité de les modifier
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<li>";
            echo "Service " . $row["service_id"] . ": ";
            echo "<form action='actions_services.php' method='post'>";
            echo "<input type='hidden' name='service_id' value='" . $row["service_id"] . "'>";
            echo "<input type='text' name='service_nom' value='" . $row["name"] . "'>";
            echo "<textarea name='service_description'>" . $row["description"] . "</textarea>";
            echo "<input type='submit' name='modifier' value='Modifier'>";
            echo "<input type='submit' name='supprimer' value='Supprimer'>";
            echo "</form>";
            echo "</li>";
            }
        } else {
        echo "Aucun service trouvé.";
     }
    } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$pdo = null;

?>
    </div>
    
</body>
</html>