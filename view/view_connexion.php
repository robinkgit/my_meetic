<?php session_start()?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_connexion.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Frank+Ruhl+Libre:wght@300..900&family=Indie+Flower&family=Satisfy&display=swap" rel="stylesheet">
    <title>My Meetic - Connexion</title>
</head>
<body>
    <img src="image/logo.png">
    <!-- <h1>Bienvenue, Veuillez vous connecter</h1> -->
    <form method="POST" id="connexion_form">
        <h3>Bienvenue, Veuillez vous connecter</h3>
        <label class="custom">
        <input type="text" name="email_connexion" required>
        <span class="placeholder">Entrez votre e-mail</span>
        </label>

        <label class="custom">
        <input type="password" name="password_connexion" required>
        <span class="placeholder">Entrez votre mot de passe</span>
        </label>

        <button type="submit" name="button_submit"><p>Connexion<p></button>
    </form>
    <a href="view_inscription.php" class="inscription">Pas encore inscrit ? Inscrivez-vous ici !</a>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="script_connexion.js"></script>
</body>
</html>