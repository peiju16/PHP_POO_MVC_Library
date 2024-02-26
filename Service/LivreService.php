<?php
namespace Service;

class LivreService implements \Interfaces\ILivreService {

    private $repository;

    // injection de dépendance
    public function __construct(\Repository\IRepository $iRepository) {
      $this->repository = $iRepository;
    }

    public function listerLivres() {
        // La logique pour lister les livres
      
        return $this->repository->selectAll();

    }


    public function ajouterLivre() {

        $this->repository->add();
          
        }

    public function modifyLivre($id) {

        $this->repository->update($id);
        
    }

    public function updateEmprunt($id) {

        $this->repository->updateEmprunt($id);
    }
     
    public function showSelectLivre($id) {
        return $this->repository->selectById($id);
    
    }


    public function deleteLivre($id) {
        $this->repository->delete($id);
        $this->repository->deleteEmprunt($id);

    }
    
    // Ajoutez ici les méthodes pour modifier et supprimer des livres

 

    
}