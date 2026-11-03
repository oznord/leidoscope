<div class="auth-div">
    <img class="auth-logo" src="include/img/logo.png" alt="logo">
    <h1>CHU : LEIDOSCOPE</h1>
</div>

<form class="auth-form" action="index.php" method="post">
    <h1 class="auth-titre">Authentification</h1>
    <label for="login">Login</label>
    <input type="text" id="login" name="login" required autocomplete="username">

    <label for="mdp">Mot de passe</label>
    <input type="password" id="mdp" name="mdp" required autocomplete="current-password">

    <button type="submit">Valider</button>
</form>