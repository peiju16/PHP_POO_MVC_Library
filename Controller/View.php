<?php

namespace Controller;

class View {

    private $viewFile;
    private $data = [];

    public function __construct($viewFile, $data = []) {
        $this->viewFile = $viewFile;
        $this->data = $data;
    }

    public function render() {
        if (file_exists($this->viewFile)) {
            
            // préparer le chargement d'une vue
            // pour l'instant ne pas encore l'afficher
            // créeer les variables de vues avec les données
            // à injecter à l'intérieur
            // et afficher la vue avec ses données

            ob_start();

            // ici je vais créer par example ma variable
            extract($this->data);

            include($this->viewFile);

            echo ob_get_clean();

        }else {
            throw new \Exception("Vue non définie pour: " . $this->viewFile);
            
        }

    }







}







?>