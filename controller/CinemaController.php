<?php

namespace Controller;
use Model\Connect;

class CinemaController {
    
    // fonction chercher tous les films
    public function listFilms() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT titre, annee_sortie
            FROM film
        ");

        require "view/film/listFilms.php";
    }

    //fonction infos acteur
    public function detActeur($id) {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM acteur
            WHERE id_acteur = :id
        ");
        $requete->execute(["id" => $id]);

        require "view/acteur/detailActeur.php";
    }
}