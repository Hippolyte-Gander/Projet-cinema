<?php

namespace Controller;
use Model\Connect;

class CinemaController {
    
    // fonctions liste films OK
    public function listFilms() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT titre, annee_sortie_france, id_film
            FROM film
            ORDER BY annee_sortie_france DESC
        ");

        require "view/film/listFilms.php";
    }
    // fonction détail film OK
    public function detailFilm($id) {
        $pdo = Connect::seConnecter();
        $requeteDetailFilm = $pdo->prepare("
            SELECT f.titre, f.annee_sortie_france, f.duree_minutes, f.synopsis, f.note, f.affiche, p.prenom, p.nom, f.id_realisateur
            FROM film f
            INNER JOIN realisateur r ON r.id_realisateur = f.id_realisateur
            INNER JOIN personne p ON p.id_personne = r.id_personne
            WHERE id_film = :id
        ");
        $requeteDetailFilm->execute(["id" => $id]);

        $requeteCasting = $pdo->prepare("
            SELECT p.prenom, p.nom, r.nom_role, j.id_acteur, r.id_role
            FROM jouer j
            INNER JOIN film f ON f.id_film = j.id_film
            INNER JOIN acteur a ON a.id_acteur = j.id_acteur
            INNER JOIN role r ON r.id_role = j.id_role
            INNER JOIN personne p ON p.id_personne = a.id_personne
            WHERE f.id_film = :id
        ");
        $requeteCasting->execute(["id" => $id]);

        require "view/film/detailFilm.php";
    }

    //fonction liste acteurs OK
    public function listActeurs() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT p.prenom, p.nom, p.date_naissance, a.id_acteur
            FROM acteur a
            INNER JOIN personne p ON p.id_personne = a.id_personne
            ORDER BY p.nom
        ");

        require "view/acteur/listActeurs.php";
    }
    // fonction detail acteur OK
    public function detailActeur($id) {
        $pdo = Connect::seConnecter();
        $requeteDetailActeur = $pdo->prepare("
        SELECT p.prenom, p.nom, p.date_naissance, p.sexe
        FROM acteur a
        INNER JOIN personne p ON p.id_personne = a.id_personne

        WHERE a.id_acteur = :id
        ");
        $requeteDetailActeur->execute(["id" => $id]);

        $requeteListFilmsActeur = $pdo->prepare("
        SELECT f.titre, f.annee_sortie_france, r.nom_role, f.id_film, j.id_role
        FROM jouer j
        INNER JOIN acteur a ON a.id_acteur = j.id_acteur
        INNER JOIN film f ON f.id_film = j.id_film
        INNER JOIN role r ON r.id_role = j.id_role
        WHERE j.id_acteur = :id
        ");
        $requeteListFilmsActeur->execute(["id" => $id]);
        
        require "view/acteur/detailActeur.php";
    }

    //fonction liste realisateurs OK
    public function listRealisateurs() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT p.prenom, p.nom, p.date_naissance, r.id_realisateur
            FROM realisateur r
            INNER JOIN personne p ON p.id_personne = r.id_personne
            ORDER BY p.nom
        ");

        require "view/realisateur/listRealisateurs.php";
    }
    // fonction détails réalisateur OK
    public function detailRealisateur($id) {
        $pdo = Connect::seConnecter();
        $requeteRealisateur = $pdo->prepare("
        SELECT p.prenom, p.nom, p.date_naissance, p.sexe
        FROM personne p
        INNER JOIN realisateur r ON r.id_personne = p.id_personne
        WHERE r.id_realisateur = :id
        ");
        $requeteRealisateur->execute(["id" => $id]);

        $requeteFilms = $pdo->prepare("
        SELECT f.titre, f.annee_sortie_france, f.id_film
        FROM film f
        INNER JOIN realisateur r ON r.id_realisateur = f.id_realisateur
        INNER JOIN personne p ON p.id_personne = r.id_personne
        WHERE r.id_realisateur = :id
        ");
        $requeteFilms->execute(["id" => $id]);
        
        require "view/realisateur/detailRealisateur.php";
    }

    // afficher tous les genres OK
    public function listGenres() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT nom_genre, id_genre
            FROM genre
            ORDER BY nom_genre ASC
        ");

        require "view/genre/listGenres.php";
    }
    // tous les films d'un genre OK
    public function listDuGenre($idGenre) {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT f.titre, f.annee_sortie_france, g.nom_genre, g.id_genre, f.id_film
            FROM film f
            INNER JOIN associer_genre ag ON ag.id_film = f.id_film
            INNER JOIN genre g ON g.id_genre = ag.id_genre
            WHERE ag.id_genre = :idGenre
        ");
        $requete->execute(["idGenre" => $idGenre]);

        require "view/genre/pageGenre.php";
    }

    // tous les roles
    public function listRoles() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT nom_role
            FROM role
            ORDER BY nom_role ASC
        ");
        $requete->execute();

        require "view/role/listRoles.php";
    }
    // details d'un rôle OK
    public function detailRole($id) {
        $pdo = Connect::seConnecter();
        $requeteRole = $pdo->prepare("
            SELECT nom_role
            FROM role
            WHERE id_role = :id
        ");
        $requeteRole->execute(["id" => $id]);

        $requeteFilm = $pdo->prepare("
        SELECT p.prenom, p.nom, f.titre, f.annee_sortie_france, f.id_film, j.id_acteur
        FROM jouer j
        INNER JOIN acteur a ON a.id_acteur = j.id_acteur
        INNER JOIN film f ON f.id_film = j.id_film
        INNER JOIN personne p ON p.id_personne = a.id_personne
        WHERE j.id_role = :id
        ORDER BY p.prenom
        ");
        $requeteFilm->execute(["id" => $id]);

        require "view/role/detailRole.php";
    }



}