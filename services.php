<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCADIA - SERVICES</title>
    <link rel="stylesheet" href="styles.css">
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
        <div class="website-header" id="servicesHeader">
            <H1>DÉCOUVREZ NOS SERVICES</H1>
        </div>
    </div>

    <div class="container"><H1 id="separator">DÉCOUVREZ UN MONDE D'ÉMERVEILLEMENT ET D'AVENTURE AU ZOO, OÙ LA<br> NATURE SE DÉVOILE DANS TOUTE SA SPLENDEUR !</H1></div>

    <div class="container">
        <div class="services-container">

        <?php
        require_once("dbConnect.php");

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }

        
        try {
            $sql = "SELECT service_id, name, description FROM service";
            $stmt = $pdo->query($sql);

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='service-p'>";
                    echo "<div class='service-content'>";
                    echo "<h1>" . htmlspecialchars($row["name"]) . "</h1>";
                    echo "<h3>" . htmlspecialchars($row["description"]) . "</h3>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>Aucun service trouvé.</p>";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }

        
        $pdo = null;
        ?>

        </div>
    </div>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="left-content">
                    <H3>13 Rue des Arbres<br>95417 Brocéliande</H3>
                </div>

                <div class="middle-content">
                    <H3>2024 Zoo Arcadia, All Rights Reserved</H3>
                </div>

                <div class="right-content">
                    <a href=""><i class="fa-brands fa-instagram fa-2xl" style="color: #14281D;"></i></a>
                    <a href=""><i class="fa-brands fa-facebook fa-2xl" style="color: #14281D;"></i></a>
                    <a href=""><i class="fa-brands fa-twitter fa-2xl" style="color: #14281D;"></i></a>
                    <a href=""><i class="fa-brands fa-pinterest fa-2xl" style="color: #14281D;"></i></a>
                </div>
            </div>
        </div>
    </footer>







    </div>
    
</body>
    <script src="https://kit.fontawesome.com/f133799ed7.js" crossorigin="anonymous"></script>
</html>