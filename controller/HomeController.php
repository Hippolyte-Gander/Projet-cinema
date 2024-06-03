<?php

namespace Controller;
use Model\Connect;

class HomeController {
    
    // fonctions liste films OK
    public function index() {

        require "view/home.php";
    }

}