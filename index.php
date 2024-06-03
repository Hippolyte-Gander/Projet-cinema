<?php

use Controller\CinemaController;
use Controller\HomeController;

spl_autoload_register(function($class_name){
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();
$ctrlHome = new HomeController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]) {
        // Films
        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "detailFilm" : $ctrlCinema->detailFilm($id); break;
        
        //Acteurs
        case "listActeurs" : $ctrlCinema->listActeurs(); break;
        case "detailActeur" : $ctrlCinema->detailActeur($id); break;
        
        //Réalisateur
        case "listRealisateurs" : $ctrlCinema->listRealisateurs(); break;
        case "detailRealisateur" : $ctrlCinema->detailRealisateur($id); break;
        
        //Genres
        case "listGenres" : $ctrlCinema->listGenres(); break;
        case "pageGenre" : $ctrlCinema->listDuGenre($id); break;

        //Rôles
        case "listRoles" : $ctrlCinema->listRoles(); break;
        case "detailRole" : $ctrlCinema->detailRole($id); break;
    }
} else {
    $ctrlHome->index(); 
}