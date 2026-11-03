<div class="auth-div">
    <img class="auth-logo" src="include/img/logo.png" alt="logo">
    <h1>CHU : LEIDOSCOPE</h1>
</div>

<form class="auth-form" action="index.php?uc=authentification&action=authentification" method="post">
    <h1 class="auth-titre">Authentification</h1>
    <label for="login">Login</label>
    <input type="email" id="login" name="login" required autocomplete="username"
        pattern="[^@\s]+@[^@\s]+\.[^@\s]+"
        title="Saisissez une adresse mail valide.">
    <?php if (isset($erreur)) : ?>
        <p><?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <label for="mdp">Mot de passe</label>
    <input type="password" id="mdp" name="mdp" required autocomplete="current-password"
        pattern="(?=.*[^A-Za-z0-9\s])(?=.{12,}$).*"
        title="Le mot de passe doit contenir au moins 12 caractères et au moins un caractère spécial.">

    <button type="submit">Valider</button>
    </form>