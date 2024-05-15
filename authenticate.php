<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arcadia_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();
    $user_type = $user['user_type'];

    switch ($user_type) {
        case 'admin':
            header("Location: PANELS/administrateur.php");
            break;
        case 'vétérinaire':
            header("Location: PANELS/vétérinaire.php");
            break;
        case 'employé':
            header("Location: PANELS/employé.html");
            break;
        default:
            header("Location: index.php");
            break;
    }
} else {

    echo "Nom d'utilisateur ou mot de passe incorrect.";
}

$conn->close();
