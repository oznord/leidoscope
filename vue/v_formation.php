<?php
function securiserFormation($valeur)
{
    return htmlspecialchars((string) $valeur, ENT_QUOTES, 'UTF-8');
}

function dateFormation($date)
{
    return (new DateTime($date))->format('d/m/Y');
}

function horaireFormation($horaire)
{
    return (new DateTime($horaire))->format('H\hi');
}
?>

<main class="formation-detail">
    <?php if ($formation === null) : ?>
        <h1>Formation introuvable</h1>
        <p>La formation demandée n'existe pas.</p>
        <a href="index.php?uc=catalogue">Retour au catalogue</a>
    <?php else : ?>
        <p><?= securiserFormation($formation['categorie']) ?></p>
        <h1><?= securiserFormation($formation['intitule']) ?></h1>

        <?php if ($message !== null) : ?>
            <p><?= securiserFormation($message) ?></p>
        <?php endif; ?>

        <p><?= securiserFormation($formation['description']) ?></p>

        <dl>
            <dt>Date</dt>
            <dd><?= dateFormation($formation['date']) ?></dd>
            <dt>Horaire</dt>
            <dd><?= horaireFormation($formation['horaire']) ?></dd>
            <dt>Lieu</dt>
            <dd><?= securiserFormation($formation['lieu']) ?></dd>
            <dt>Formateur</dt>
            <dd><?= securiserFormation($formation['formateur']) ?></dd>
        </dl>

        <?php if ($formationComplete) : ?>
            <p>Cette formation est complète.</p>
        <?php elseif ($creneauOccupe) : ?>
            <p>Vous avez déjà une activité sur ce créneau.</p>
        <?php endif; ?>

        <form method="post" action="index.php?uc=formation&id=<?= (int) $formation['id'] ?>">
            <button type="submit" <?= ($formationComplete || $creneauOccupe) ? 'disabled' : '' ?>>
                Choisir cette formation
            </button>
        </form>

        <p><a href="index.php?uc=catalogue">Retour au catalogue</a></p>
    <?php endif; ?>
</main>
