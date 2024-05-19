<?php
require 'connect.php'; // Assurez-vous que le fichier connect.php établit une connexion PDO

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

if ($username && $password) {
    // Utilisation de requête préparée pour éviter les attaques par injection SQL
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    
    // Vérifier si l'utilisateur existe
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch();
        $hashedPassword = $user['password'];
        
        // Vérification du mot de passe avec password_verify
        if (password_verify($password, $hashedPassword)) {
            $user_type = $user['user_type'];

            switch ($user_type) {
                case 'admin':
                    header("Location: administrateur.php");
                    exit(); // Assurez-vous de sortir après la redirection
                case 'vétérinaire':
                    header("Location: vétérinaire.php");
                    exit();
                case 'employé':
                    header("Location: employé.html");
                    exit();
                default:
                    header("Location: index.php");
                    exit();
            }
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
} else {
    echo "Tous les champs sont obligatoires.";
}


