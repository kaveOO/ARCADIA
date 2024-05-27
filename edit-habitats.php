<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les Habitats</title>
    <style>
        .habitat {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Gérer les Habitats</h1>

    <h2>Ajouter un nouvel Habitat</h2>
    <form action="actions_habitats.php" method="post" enctype="multipart/form-data">
        <label for="nouveau_nom">Nom de l'Habitat:</label>
        <input type="text" id="nouveau_nom" name="nouveau_nom" required>
        <br>
        <label for="nouvelle_description">Description de l'Habitat:</label>
        <textarea id="nouvelle_description" name="nouvelle_description" required></textarea>
        <br>
        <label for="nouveau_commentaire">Commentaire:</label>
        <textarea id="nouveau_commentaire" name="nouveau_commentaire"></textarea>
        <br>
        <label for="nouvelle_image">Image de l'Habitat:</label>
        <input type="file" id="nouvelle_image" name="nouvelle_image" accept="image/*" required>
        <br>
        <input type="submit" name="ajouter" value="Ajouter Habitat">
    </form>

    <h2>Habitats Existants</h2>
    <?php
    require_once("dbConnect.php");

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT h.habitat_id, h.name AS habitat_name, h.description AS habitat_description, h.commentary AS habitat_commentary, i.image_path 
                FROM habitat h 
                LEFT JOIN image i ON h.habitat_id = i.habitat_id";
        $stmt = $pdo->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $habitatId = $row['habitat_id'];
            $habitatName = htmlspecialchars($row['habitat_name']);
            $habitatDescription = htmlspecialchars($row['habitat_description']);
            $habitatCommentary = htmlspecialchars($row['habitat_commentary']);
            $imagePath = htmlspecialchars($row['image_path']);
            ?>
            <div class="habitat">
                <form action="actions_habitats.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="habitat_id" value="<?= $habitatId ?>">
                    <label for="nom_<?= $habitatId ?>">Nom de l'Habitat:</label>
                    <input type="text" id="nom_<?= $habitatId ?>" name="habitat_nom" value="<?= $habitatName ?>" required>
                    <br>
                    <label for="description_<?= $habitatId ?>">Description de l'Habitat:</label>
                    <textarea id="description_<?= $habitatId ?>" name="habitat_description" required><?= $habitatDescription ?></textarea>
                    <br>
                    <label for="commentaire_<?= $habitatId ?>">Commentaire:</label>
                    <textarea id="commentaire_<?= $habitatId ?>" name="habitat_commentary" required><?= $habitatCommentary ?></textarea>
                    <br>
                    <?php if ($imagePath): ?>
                        <img src="<?= $imagePath ?>" alt="Image de <?= $habitatName ?>" style="max-width: 200px;">
                    <?php endif; ?>
                    <br>
                    <label for="image_<?= $habitatId ?>">Changer l'image de l'Habitat:</label>
                    <input type="file" id="image_<?= $habitatId ?>" name="habitat_image" accept="image/*">
                    <br>
                    <input type="submit" name="modifier" value="Modifier">
                    <input type="submit" name="supprimer" value="Supprimer">
                </form>
            </div>
            <?php
        }

    } catch (PDOException $e) {
        echo "Erreur de base de données : " . $e->getMessage();
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $pdo = null;
    ?>

    <div class="container">
        <a href="administrateur.php">RETOURNER AU PANEL</a>
    </div>
</body>
</html>
