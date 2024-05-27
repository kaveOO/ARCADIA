<?php

session_start();

require("dbConnect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['username']); 
    $password = trim($_POST['password']); 

    
    $stmtUser = $conn->prepare('SELECT * FROM users WHERE email = ?');
    $stmtUser->bind_param('s', $email);
    $stmtUser->execute();
    $resultUser = $stmtUser->get_result();
    $user = $resultUser->fetch_assoc();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user'] = $user;
        $_SESSION['userId'] = $user['userId']; 
        $userId = $user['userId'];

        
        $stmtRole = $conn->prepare("SELECT label FROM roles WHERE userId = ?");
        $stmtRole->bind_param('i', $userId);
        $stmtRole->execute();
        $resultRole = $stmtRole->get_result();
        $role = $resultRole->fetch_assoc();

        if ($role) {
            $label = $role['label'];

            if ($label == 'Administrator') {
                header('Location: adminPanel.php');
            } elseif ($label == 'Veterinarian') {
                header('Location: veterPanel.php');
            } elseif ($label == 'Employee') {
                header('Location: employPanel.php');
            }
            exit;
        } else {
            echo "Role not found for the user.";
        }
    } else {
        echo "Email or password incorrect.";
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
    
    <div class="login">
        <H1>SE CONNECTER</H1>
        <form action="login.php" method="post">
            <label for="username">
                <i class="fa-solid fa-user fa-2xl"></i>
            </label>
            <input type="text" name="username" placeholder="Username" id="username" required>
            <label for="password">
                <i class="fa-solid fa-key fa-2xl"></i>
            </label>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <input type="submit" value="CONNEXION">
        </form>
    </div>
</body>
    <script src="https://kit.fontawesome.com/f133799ed7.js" crossorigin="anonymous"></script>
</html>
