<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCADIA - HABITATS</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .habitat {
            position: relative;
            height: 700px;
            margin-bottom: 20px;
            padding: 20px;
            color: white;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 8px;
            overflow: hidden;
        }
        .habitat-content {
            position: relative;
            z-index: 2;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border-radius: 8px;
        }
        .habitat::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: inherit;
            z-index: 1;
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <header>
        <img src="IMAGES/LOGO ARCADIA.png" alt="LOGO ZOO">
        <nav>
            <a href="index.php">ACCUEIL</a>
            <a href="services.php">SERVICES</a>
            <a href="habitats.php">HABITATS</a>
            <a href="contact.php">CONTACT</a>
        </nav>
        <a href="login.php" id="connectButton">CONNEXION</a>
    </header>

    <div class="container">
        <div class="website-header" id="habitatsHeader">
            <H1>DÉCOUVREZ LES HABITATS</H1>
        </div>
    </div>

    <H1 id="separator">EXPLOREZ LES HABITATS DIVERSIFIÉS DE NOTRE ZOO, OÙ CHAQUE PAS VOUS TRANSPORTE DANS UN MONDE NOUVEAU ET CAPTIVANT !</H1>

    <div class="container">
        <div class="habitats-container">
            <?php
            require_once("connect.php");

            try {
                $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT h.habitat_id, h.name, h.description, h.commentary, i.image_path 
                        FROM habitat h 
                        LEFT JOIN image i ON h.habitat_id = i.habitat_id";
                $stmt = $pdo->query($sql);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $habitatId = $row['habitat_id'];
                    $habitatName = htmlspecialchars($row['name']);
                    $habitatDescription = htmlspecialchars($row['description']);
                    $habitatCommentary = htmlspecialchars($row['commentary']);
                    $imagePath = htmlspecialchars($row['image_path']);
                    
                    ?>
                    <div class="habitat" id="habitat_<?= $habitatId ?>" style="background-image: url('<?= $imagePath ?>');">
                        <div class="habitat-content">
                            <h1><?= $habitatName ?></h1>
                            <h3><?= $habitatDescription ?></h3>
                        </div>
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
        </div>
    </div>
</body>
</html>
