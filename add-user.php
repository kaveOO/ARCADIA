<?php
require 'dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;
    $user_type = $_POST['user_type'] ?? null;

    if ($username && $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (username, password, user_type) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$username, $hashedPassword, $user_type])) {
            header("location: administrateur.php");
        } else {
            echo "Erreur lors de l'ajout de l'utilisateur.";
        }
    }   
}
?>

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
        <div class="add-user-container">
            <div class="add-user-pop">
                <h2>CREER UN COMPTE UTILISATEUR</h2>
                <form action="add-user.php" method="POST" class="add-user-form">

                    <input type="email" name="username" placeholder="ADRESSE EMAIL" required><br>

                    <input type="password" name="password" placeholder="MOT DE PASSE" required><br>
        
                    <select name="user_type">
                        <option value="vétérinaire">VETERINAIRE</option>
                        <option value="employé">EMPLOYE</option>
                    </select>

                    <input type="submit" value="CREER LE COMPTE">
                </form>

                <a href="administrateur.php">RETOURNER AU PANEL</a>
            </div>
        </div>
    </div>
</body>
</html>