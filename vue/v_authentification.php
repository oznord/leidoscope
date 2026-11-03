<h1>Authentification</h1>

<?php if (isset($erreur)) : ?>
    <p><?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

<form action="index.php?uc=authentification&action=authentification" method="post">
    <div>
        <label for="login">Login</label>
        <input type="email" id="login" name="login" required autocomplete="username"
            pattern="[^@\s]+@[^@\s]+\.[^@\s]+"
            title="Saisissez une adresse mail valide.">
    </div>

    <div>
        <label for="mdp">Mot de passe</label>
        <input type="password" id="mdp" name="mdp" required autocomplete="current-password"
            pattern="(?=.*[^A-Za-z0-9\s])(?=.{12,}$).*"
            title="Le mot de passe doit contenir au moins 12 caractères et au moins un caractère spécial.">
    </div>

    <button type="submit">Valider</button>
</form>