<?php
include 'connect.php';




// fonction chercher tous les films
public function listFilms() {
    $pdo = Connect::seConnecter();
    $requete = $pdo-->query("
    SELECT titre, annee_sortie
    FROM film
    ");

    require "./view/listFilms.php";
}


?>