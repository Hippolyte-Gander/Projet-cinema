<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> réalisateurs</p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Date de naissance</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $realisateur){ ?>
                <tr>
                    <td><?= $realisateur["prenom"] ?> </td>
                    <td><?= $realisateur["nom"] ?> </td>
                    <td><?= $realisateur["date_naissance"] ?> </td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des rélisateurs";
$titre_secondaire = "Liste des rélisateurs";
$contenu = ob_get_clean();
require "view/template.php";