<?php


    function inclusionAuto($nomClasse) {

        // new Controller\LivreController
        // transform en : ./Controller/LivreController.php

        require_once("./" . str_replace("\\", "/", $nomClasse) . ".php");

    }

    spl_autoload_register("inclusionAuto");

?>