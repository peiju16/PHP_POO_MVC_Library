<?php

namespace Controller;

// ce controller est responsable des interactions avec les vues liées aux livres
// sont objectif et de retourner une vue avec des données à l'intérieur
// pour cela il devra intercepter les requêtes
// intérroger le bon service
// récupérer les données et les passer à une vue qu'il devra retourner

class LivreController
{

    private $service;

    public function __construct(\Interfaces\ILivreService $service)
    {
        $this->service = $service;

    }


    // elle va intercepter les urls
    // et dire quelle méthode appeler dans mon controller
    // et donc quelle vue retourner avec quelles données

    public function route()
    {


        if (!isset($_GET["action"])) {
            $this->listerLivres();
        } else {
            if ($_GET["action"] == "add") {
                $this->ajouterLivre();
            }
            if ($_GET["action"] == "modify") {
                $this->modifyLivre();
            }
            if ($_GET["action"] == "delete") {
                $this->deleteLivre();
            }
        }

    }

    public function listerLivres()
    {

        try {
            $livres = $this->service->listerLivres();
            $view = new View("Vues/lister_livres.php", ['livres' => $livres]);
            $view->render();

        } catch (\Exception $e) {
            (new View("Vues/erreur.php", ['error' => $e->getMessage()]))->render();
        }

    }

    public function ajouterLivre()
    {

        if ($_POST) {

            foreach ($_POST as $index => $value) {
                $_POST[$index] = addslashes($value);
            }


            try {
                $livres = $this->service->listerLivres();
                $this->service->ajouterLivre();
                $view = new View("Vues/lister_livres.php", ['msg' => "Votre livre a bien été ajouté", "livres" => $livres]);
                $view->render();

            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            $view = new View("Vues/ajouter_livre.php");
            $view->render();
        }


    }

    public function modifyLivre()
    {

        if ($_POST) {
            foreach ($_POST as $index => $value) {
                $_POST[$index] = addslashes($value);
            }

        // if (isset($_POST["disponible"]) && $_POST["disponible"]  == "on") {
        //     $_POST["disponible"] = 1;
        // } else {
        //     $_POST["disponible"] = 0;
        //     $this->service->updateEmprunt($_POST["id"]);
        // }

            $_POST["disponible"] = (isset($_POST["disponible"]) && $_POST["disponible"])  == "on" ? 1 : 0;

            try {
                $this->service->modifyLivre($_POST["id"]);
                $livres = $this->service->listerLivres();
                $view = new View("Vues/lister_livres.php", ['msg' => "Votre livre a bien été modifié", "livres" => $livres]);
                $view->render();

            } catch (\Exception $e) {
                (new View("Vues/erreur.php", ['error' => $e->getMessage()]))->render();
            }

        } else {

            $livre = $this->service->showSelectLivre($_GET['id']);
            $view = new View("Vues/ajouter_livre.php", ["livre" => $livre]);
            $view->render();

        }


    }

    public function deleteLivre() {

        try {
            $this->service->deleteLivre($_GET["id"]);
            $livres = $this->service->listerLivres();
            $view = new View("Vues/lister_livres.php", ['msg' => "Votre livre a bien été modifié", "livres" => $livres]);
            $view->render();

        } catch (\Exception $e) {
            (new View("Vues/erreur.php", ['error' => $e->getMessage()]))->render();
        }




    }





}







?>