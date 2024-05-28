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

        require "./view/listFilms.php";
    }
}