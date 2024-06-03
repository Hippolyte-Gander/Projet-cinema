<?php ob_start(); ?>

<h1>Home</h1>

<?php
$titre = "Home";
$titre_secondaire = "Home";
$contenu = ob_get_clean();
require "view/template.php";