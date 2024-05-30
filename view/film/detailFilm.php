<?php

$film = $requeteFilm->fetch();
echo $film["titre"];

$casting = $requeteCasting->fetchAll();
foreach($casting as $cast) {
echo $cast["acteur"]." dans le rôle de ".$cast["role"];
}




?>