<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_connexion.css">
    <link href="https://fonts.cdnfonts.com/css/lindra" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <title>Recherche - My Meetic</title>
</head>
<body>
<video id="background-video" autoplay loop muted >
  <source src="sky.mp4" type="video/mp4">
</video>
    <h1 class="h1_recherche">Recherche</h1>
    <form  method="POST" id="recherche" id="recherche">
        <fieldset>
            <legend>Filtres de Recherche</legend>
            <label>Par Genre :</label>
            <select id="genre" name ="genre">
                <option value =""> -- Sélectionner un genre -- </option>
                <option value="homme">homme</option>
                <option value="femme">femme</option>
                <option value="autre">autre</option>
            </select><br>

            <div class="loisir">
            <label>Par Ville :</label>
            <input type="checkbox" name="ville" value="Paris"><label>Paris</label>
            <input type="checkbox" name="ville" value="lyon"><label>Lyon</label>
            <input type="checkbox" name="ville" value="marseille"><label>Marseille</label>
            </div>

            <div class="loisir">
            <label>Par Loisir :</label>
            <input type="checkbox" name="loisir" value="sport"><label>Sport</label>
            <input type="checkbox" name="loisir" value="lecture"><label>Lecture</label>
            <input type="checkbox" name="loisir" value="serie_film"><label>Serie_film</label>
            <input type="checkbox" name="loisir" value="jeux_video"><label>Jeux_video</label>
            <input type="checkbox" name="loisir" value="manga"><label>Mangas</label>
            </div>
            <label>Par Tranche d'âge :</label>
            <select id="tranche_age" name="tranche_age">
                <option value ="">--Selectioner une tranche d'âge--</option>
                <option value="18/25">18/25</option>
                <option value="25/35">25/35</option>
                <option value="35/45">35/45</option>
                <option value="45+">45+</option>  
            </select><br>
            <button type="submit" class="button_recherche"><p>Recherche</p></button>
        </fieldset>
    </form>
    <div id="result_recherche"></div>
    <div id="next-previous"></div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="script_recherche.js"></script>
</body>
</html>