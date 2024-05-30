<?php

namespace Controller;
use Model\Connect;

class CinemaController {
    
    // fonctions films
    public function listFilms() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT titre, annee_sortie
            FROM film
        ");

        require "view/film/listFilms.php";
    }

    public function detailFilm($id) {
        $pdo = Connect::seConnecter();
        $requeteFilm = $pdo->prepare("
            SELECT *
            FROM film
            WHERE id_film = :id
        ");
        $requeteFilm->execute(["id" => $id]);

        $requeteCasting = $pdo->prepare("
            SELECT acteur, role
            FROM casting c
            INNER JOIN film f ON f.id_film = c.id_film
            WHERE f.id_film = :id
        ");
        $requeteCasting->execute(["id" => $id]);

        require "view/film/detailFilm.php";
    }
    
    
    
    //fonction acteurs
    public function listActeurs() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT prenom, nom
            FROM acteur
        ");

        require "view/acteur/listActeur.php";
    }

    public function detailActeur($id) {
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