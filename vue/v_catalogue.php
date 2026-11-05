<?php
function securiserCatalogue($valeur)
{
    return htmlspecialchars($valeur, ENT_QUOTES, 'UTF-8');
}

function dateCatalogue($date)
{
    return (new DateTime($date))->format('d/m/Y');
}

function horaireCatalogue($horaire)
{
    return (new DateTime($horaire))->format('H\hi');
}
?>

<main class="catalogue">
    <header class="catalogue-entete">
        <p class="catalogue-sur-titre">Développement des compétences</p>
        <h1>Catalogue des formations</h1>
        <p>Consultez les prochaines formations proposées par le centre hospitalier LEIDOSCOPE.</p>
    </header>

    <form class="catalogue-filtres" method="get" action="index.php">
        <input type="hidden" name="uc" value="catalogue">

        <div class="catalogue-champ catalogue-recherche">
            <label for="mot_cle">Rechercher une formation</label>
            <input type="search" id="mot_cle" name="mot_cle"
                   value="<?= securiserCatalogue($motCle) ?>"
                   placeholder="Mot-clé, lieu ou intitulé">
        </div>

        <div class="catalogue-champ">
            <label for="categorie">Catégorie</label>
            <select id="categorie" name="categorie">
                <option value="">Toutes les catégories</option>
                <?php foreach ($categories as $nomCategorie) : ?>
                    <option value="<?= securiserCatalogue($nomCategorie['id']) ?>"
                        <?= $categorie === (string) $nomCategorie['id'] ? 'selected' : '' ?>>
                        <?= securiserCatalogue($nomCategorie['libelle']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="catalogue-champ">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" value="<?= securiserCatalogue($date) ?>">
        </div>

        <button class="catalogue-bouton" type="submit">Rechercher</button>
        <a class="catalogue-reset" href="index.php?uc=catalogue">Réinitialiser</a>
    </form>

    <div class="catalogue-resultats">
        <p><?= count($formationsFiltrees) ?> formation<?= count($formationsFiltrees) > 1 ? 's' : '' ?> disponible<?= count($formationsFiltrees) > 1 ? 's' : '' ?></p>
    </div>

    <?php if (empty($formationsFiltrees)) : ?>
        <section class="catalogue-vide">
            <h2>Aucune formation trouvée</h2>
            <p>Modifiez vos critères de recherche pour afficher d’autres formations.</p>
        </section>
    <?php else : ?>
        <section class="catalogue-cartes" aria-label="Formations disponibles">
            <?php foreach ($formationsFiltrees as $formation) : ?>
                <?php $placesRestantes = $formation['places'] - $formation['inscrits']; ?>
                <article class="formation-carte">
                    <div class="formation-carte-haut">
                        <span class="formation-categorie"><?= securiserCatalogue($formation['categorie']) ?></span>
                        <?php if ($placesRestantes === 0) : ?>
                            <span class="formation-complet">Complet</span>
                        <?php endif; ?>
                    </div>
                    <h2>
                        <a href="index.php?uc=formation&id=<?= (int) $formation['id'] ?>">
                            <?= securiserCatalogue($formation['intitule']) ?>
                        </a>
                    </h2>
                    <dl class="formation-informations">
                        <div>
                            <dt>Date</dt>
                            <dd><?= dateCatalogue($formation['date']) ?></dd>
                        </div>
                        <div>
                            <dt>Horaire</dt>
                            <dd><?= horaireCatalogue($formation['horaire']) ?></dd>
                        </div>
                        <div>
                            <dt>Lieu</dt>
                            <dd><?= securiserCatalogue($formation['lieu']) ?></dd>
                        </div>
                    </dl>
                    <p class="formation-places <?= $placesRestantes === 0 ? 'formation-places-complet' : '' ?>">
                        <?= $placesRestantes ?> place<?= $placesRestantes > 1 ? 's' : '' ?> restante<?= $placesRestantes > 1 ? 's' : '' ?>
                        <span><?= $formation['inscrits'] ?>/<?= $formation['places'] ?> inscrits</span>
                    </p>
                </article>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>
</main>