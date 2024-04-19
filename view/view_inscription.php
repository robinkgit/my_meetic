<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_connexion.css">
    <link href="https://fonts.cdnfonts.com/css/lindra" rel="stylesheet">
    <title>My meetic - Inscription</title>
</head>
<body>
    <img src="image/logo.png">
    <form method="POST" id="inscription_form">
    <h3>Bienvenue sur la page d'inscription</h3>
        <label class="custom">
        <input type="text" name="name_inscription" required>
        <span class="placeholder">Nom</span>
        </label>

        <label class="custom">
        <input type="text" name="prenom_inscription" required>
        <span class="placeholder">Prénom</span>
        </label>
        
        <label class="custom">
        <input type="date" name="date_inscription" class="date" required>
        <span class="placeholder">Date de naissance</span>
        </label>
        
        
        <div class="genre">
        <!-- <label>Genre :</label> -->
        <input type="radio" name="genre_inscription" value="homme"><label>Homme</label>
        <input type="radio" name="genre_inscription" value="femme"><label>Femme</label>
        <input type="radio" name="genre_inscription" value="autre"><label>Autre</label>
        </div>
        
        <div class="ville">
        <select name="ville_inscription" id="ville_inscription">
            <option value ="">--SELECTIONNER VOTRE VILLE --</option>
            <option value="paris">Paris</option>
            <option value="marseille">Marseille</option>
            <option value="lyon">Lyon</option>
        </select>
        </div>

        <label class="custom">
        <input type="text" name="email_inscription" required>
        <span class="placeholder">E-mail</span>
        </label>



        <label class="custom">
        <input type="password" name="password_inscription" required>
        <span class="placeholder">Mot de passe</span>
        </label>

        <div class="loisir">
        <label>Loisir :</label>
        <input type="checkbox" name="loisir_inscription" value="sport"><label>Sport</label>
        <input type="checkbox" name="loisir_inscription" value="lecture"><label>Lecture</label>
        <input type="checkbox" name="loisir_inscription" value="serie_film"><label>Serie/Film</label>
        <input type="checkbox" name="loisir_inscription" value="jeux_video"><label>Jeux-video</label>
        <input type="checkbox" name="loisir_inscription" value="manga"><label>Manga</label><br>
        </div>

    
        <button type="submit" name="submit_inscription"><p>S'inscrire</p></button>
    </form>
    <a href="view_connexion.php" class ="connexion_a">Deja inscrit ? Connectez-vous ici !</a>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>