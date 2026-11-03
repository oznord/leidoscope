<h1>Authentification</h1>

<form action="index.php" method="post">
    <div>
        <label for="login">Login</label>
        <input type="text" id="login" name="login" required autocomplete="username">
    </div>

    <div>
        <label for="mdp">Mot de passe</label>
        <input type="password" id="mdp" name="mdp" required autocomplete="current-password">
    </div>

    <button type="submit">Valider</button>
</form>