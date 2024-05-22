<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCADIA - CONTACT</title>
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

    <section class="contact-section">
        <div class="contact-intro">
          <h2 class="contact-title">CONTACTEZ-NOUS</h2>
          <p class="contact-description">
            Veuillez remplir le formulaire ci-dessous, nous y répondrons au plus vite.
          </p>
        </div>
      
        <form class="contact-form" action="https://api.web3forms.com/submit" method="POST">
      
          <input type="hidden" name="access_key" value="2da8fd5c-ee0c-4b57-8f0a-fdba0f479136" />
          <input type="hidden" name="from_name" value="FORM ARCADIA"/>
      
          <div class="form-group-container">
            <div class="form-group">
              <label for="name" class="form-label">Sujet</label>
              <input id="name" name="subject" class="form-input" placeholder="Sujet du message" type="text" />
            </div>
            <div class="form-group">
              <label for="email" class="form-label">Email</label>
              <input id="email" name="email" class="form-input" placeholder="Adresse Email" type="email" />
            </div>
            <div class="form-group">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-textarea" id="message" name="message" placeholder="Votre message"></textarea>
            </div>
            <div class="h-captcha" data-captcha="true"></div>
          </div>
          <button class="form-submit" type="submit">Envoyer le message</button>
        </form>
      
      </section>

</body>
    <script src="https://web3forms.com/client/script.js" async defer></script>
</html>