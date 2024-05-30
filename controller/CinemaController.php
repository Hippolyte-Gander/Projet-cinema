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

    //fonction realisateurs
    public function listRealisateurs() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT prenom, nom
            FROM realisateur
        ");

        require "view/realisateur/listRealisateur.php";
    }
    
    public function detailRealisateur($id) {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
        SELECT *
        FROM realisateur
        WHERE id_realisateur = :id
        ");
        $requete->execute(["id" => $id]);
        
        require "view/realisateur/detailRealisateur.php";
    }

    //fonction genres
    //tous les genres
    public function listGenres() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT nom_genre
            FROM genre
        ");

        require "view/genre/listGenres.php";
    }
    // tous les films d'un genre
    public function listDuGenre($idFilm, $idGenre) {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT titre, annee_sortie
            FROM film f
            INNER JOIN associer_genre ag ON ag.id_film = f.id_film
            WHERE f.id_film = :idFilm
            AND ag.id_genre = :idGenre
        ");
        $requete->execute(["idFilm" => $idFilm, "idGenre" => $idGenre]);

        require "view/genre/pageGenre.php";
    }


}