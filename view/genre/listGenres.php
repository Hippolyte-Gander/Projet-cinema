<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> genres</p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>Genre</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $genre){ ?>
                <tr>
                    <td>
                        <a href="index.php?action=pageGenre&id=<?=$genre["id_genre"]?>"><?= $genre["nom_genre"] ?></a>
                    </td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();
require "view/template.php";