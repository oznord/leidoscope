<div class="accueil-contexte">

<?php
    if(!isset($_SESSION['login']))
        echo '<form action="index.php?uc=authentification&action=authentification" method = "POST" align="right">

        <input type="email" name="login" placeholder="Adresse mail" required
               pattern="[^@\s]+@[^@\s]+\.[^@\s]+"
               title="Saisissez une adresse mail valide.">
        <input type="password" name="mdp" placeholder="Mot de passe" required
               pattern="(?=.*[^A-Za-z0-9\s])(?=.{12,}$).*"
               title="Le mot de passe doit contenir au moins 12 caractères et au moins un caractère spécial.">
        <input type="submit" value="OK">

        </form>';
?>
    <h1>Bienvenue au centre hospitalier LEIDOSCOPE</h1>

    <h2>est un établissement privé de santé ayant les missions suivantes :</h2>

    <p>une mission de soins en assurant les examens, les diagnostics, le traitement des
    personnes hospitalisées et des consultants externes ainsi que l’aide médicale urgente ;</p>

    <p>une mission d’hébergement dans un établissement pour personnes âgées dépendantes,
    d’une capacité de 900 lits</p>

    <p>une mission d’enseignement et de formation dans une école d’aides-soignants ainsi qu’au
    sein de ses services qui reçoivent des stagiaires de formations diverses</p>

    <p>une mission de prévention et d’éducation pour la santé concernant le tabagisme,
    l’alcoolisme, la toxicomanie et les pathologies cardiovasculaires notamment.</p>

</div>