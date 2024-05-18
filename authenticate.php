<?php

include("connect.php");

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();
    $user_type = $user['user_type'];

    switch ($user_type) {
        case 'admin':
            header("Location: administrateur.php");
            break;
        case 'vétérinaire':
            header("Location: vétérinaire.php");
            break;
        case 'employé':
            header("Location: employé.html");
            break;
        default:
            header("Location: index.php");
            break;
    }
} else {

    echo "Nom d'utilisateur ou mot de passe incorrect.";
}

$conn->close();
