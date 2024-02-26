<?php

require_once("Config/autoload.php");



if (isset($_GET["page"]) && $_GET["page"] == "livre") {
    $repo = new \Repository\LivreRepository;
    $service = new Service\LivreService($repo);
    $controller = new Controller\LivreController($service);

// si dans mon url j'ai emprunt
// le controller responsable de gérer la vue ce sera EmpruntController
} else {
    $repo = new \Repository\EmpruntRepository;
    $service = new Service\EmpruntService($repo);
    $controller = new Controller\EmpruntController($service);
} 

$controller->route();
// la finalité c'est que je vias rendre une vue dans index.php
// si je suis en GET et que je rentre dans la deuxiéme condition
// je inclure dans index.php lister_emprunt.php avec des cariables à l'intérieur


?>

<nav>

    <ul>
        <li><a href="?page=livre">Lister les livres</a></li>
        <li><a href="?page=emprunt">Lister les emprunts</a></li>
    </ul>

</nav>