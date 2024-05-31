<?php ob_start();
?>


<?php
    foreach($requeteDetailFilm->fetchAll() as $info){ ?>
        <p> Sorti en <?=$info["annee_sortie_france"]?>
        <p> Durée: <?=$info["duree_minutes"]?> minutes
        <p> Synopsis: <?=$info["synopsis"]?>
        <p> Note globale: <?=$info["note"]?>
        <p> Réalisateur: <?=$info["annee_sortie_france"]?>
    <?php } ?>

<table class="uk-table uk-table-striped">
    <tbody>
        <?php
            foreach($requeteCasting->fetchAll() as $cast){ ?>
                <tr>
                    <td><?= $cast["prenom"]." ".$cast["nom"]." dans le rôle de ".$cast["nom_role"] ?> </td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php
$titre = $info["titre"];
$titre_secondaire = $info["titre"];
$contenu = ob_get_clean();
require "view/template.php";