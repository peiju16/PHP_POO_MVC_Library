<?php

namespace Controller;

class EmpruntController
{

    private $service;

    // injection de dépendance
    // je vais injecter la dépendance du controller au service
    // via le controller
    public function __construct(\Interfaces\IEmpruntService $service)
    {
        $this->service = $service;

    }

    public function route()
    {

        if (!isset($_GET["action"]))
            $this->listerEmprunts();
        else
            $this->enregistrerEmprunt();

    }

    public function listerEmprunts()
    {

        try {
            $emprunts = $this->service->listerEmprunts();
            $view = new View("Vues/lister_emprunt.php", ['emprunts' => $emprunts]);
            $view->render();

        } catch (\Exception $e) {
            (new View("Vues/erreur.php", ['error' => $e->getMessage()]))->render();
        }


    }

    public function enregistrerEmprunt()
    {

        if ($_POST) {

            foreach ($_POST as $index => $value) {
                $_POST[$index] = addslashes($value);
            }

            extract($_POST);

            $_POST["date_emprunt"] = date("Y-m-d"); // date aujourd'hui

            try {
                $this->service->enregistrerEmprunt($_POST["livre_id"]);
                $emprunts = $this->service->listerEmprunts();
                $view = new View("Vues/lister_emprunt.php", ['msg' => "Votre emprunt a bien été enregistré", 'emprunts' => $emprunts]);
                $view->render();

            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            $livres = $this->service->selectLivresDispo();
            $view = new View("Vues/enregistrer_emprunt.php", ["livresDisponibles" => $livres]);
            $view->render();
        }


    }


}






?>