<?php ob_start();?>

<table class="uk-table uk-table-striped">
    <tbody>
        <?php
            foreach($requete->fetchAll() as $film){ ?>
                <tr>
                    <td><a href="index.php?action=detailFilm&id=<?=$film["id_film"]?>"><?= $film["titre"]?></a></td>
                    <td><?= $film["annee_sortie_france"]?></td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php
$titre = "Films du genre ".$film["nom_genre"];
$titre_secondaire = "Films du genre ".$film["nom_genre"];
$contenu = ob_get_clean();
require "view/template.php";