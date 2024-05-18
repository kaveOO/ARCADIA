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
            <a href="index.html">ACCUEIL</a>
            <a href="services.html">SERVICES</a>
            <a href="habitats.html">HABITATS</a>
            <a href="contact.html">CONTACT</a>
        </nav>

        <a href="login.html" id="connectButton">CONNEXION</a>
    </header>
    
    <div class="login">
        <H1>SE CONNECTER</H1>
        <form action="authenticate.php" method="post">
            <label for="username">
                <i class="fa-solid fa-user fa-2xl"></i>
            </label>
            <input type="text" name="username" placeholder="Username" id="username" required>
            <label for="password">
                <i class="fa-solid fa-key fa-2xl"></i>
            </label>
            <input type="text" name="password" placeholder="Password" id="password" required>
            <input type="submit" value="CONNEXION">
        </form>
    </div>
</body>
    <script src="https://kit.fontawesome.com/f133799ed7.js" crossorigin="anonymous"></script>
</html>