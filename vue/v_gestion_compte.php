<?php
function securiserCompte($valeur)
{
    return htmlspecialchars($valeur, ENT_QUOTES, 'UTF-8');
}
?>

<main class="catalogue">
    <button class="gestion-compte-ajouter-button">Ajouter un compte</button>
    <h1>Liste des comptes :</h1>
    <section class="catalogue-cartes">
        <?php foreach ($utilisateurs as $util) : ?>
            <article class="formation-carte">
                <h2><?= securiserCompte($util['nom'] . ' ' . $util['prenom']) ?></h2>
                <dl class="formation-informations">
                    <div>
                        <dt>Rôle</dt>
                        <dd><?= securiserCompte($util['role']) ?></dd>
                    </div>
                    <div>
                        <dt>Service</dt>
                        <dd><?= securiserCompte($util['service']) ?></dd>
                    </div>
                    <div>
                        <dt>Email</dt>
                        <dd><?= securiserCompte($util['login']) ?></dd>
                    </div>
                </dl>
                <div class="gestion-compte-boutons">
                    <button class="gestion-compte-button">Modifier le mot de passe</button>
                    <button class="gestion-compte-button">Supprimer l'utilisateur</button>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
</main>