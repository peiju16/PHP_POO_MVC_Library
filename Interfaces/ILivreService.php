<?php

namespace Interfaces;

interface ILivreService {

    public function listerLivres();
    public function ajouterLivre();
    public function showSelectLivre($id);
    public function modifyLivre($id);
    public function deleteLivre($id);
    public function updateEmprunt($id);

}










?>