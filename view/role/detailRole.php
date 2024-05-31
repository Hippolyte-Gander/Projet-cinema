<?php ob_start();
foreach($requeteRole->fetchAll() as $role){}?>

<table class="uk-table uk-table-striped">
<thead>
        <tr>
            <th>Acteur</th>
            <th>Film</th>
            <th>Année de sortie en France</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requeteFilm->fetchAll() as $film){ ?>
                <tr>
                    <td> <a href="index.php?action=detailActeur&id=<?=$film["id_acteur"]?>"><?= $film["prenom"]?><?= $film["nom"]?></a></td>
                    <td><a href="index.php?action=detailFilm&id=<?=$film["id_film"]?>"><?= $film["titre"]?></a></td>
                    <td><?= $film["annee_sortie_france"]?></td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php
$titre = $role["nom_role"];
$titre_secondaire = $role["nom_role"];
$contenu = ob_get_clean();
require "view/template.php";