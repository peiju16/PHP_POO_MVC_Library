<?php

namespace Service;

class EmpruntService implements \Interfaces\IEmpruntService {

    private $repository;

    public function __construct(\Repository\IRepository $iRepository) {
        $this->repository = $iRepository;
      }
  

    public function enregistrerEmprunt($livre_id) {

        $this->repository->add();
        $this->repository->borrowBook($livre_id);
     
    }

    public function listerEmprunts() {
        // La logique pour lister les emprunts
    
        return $this->repository->selectAll();

    }

   
    public function selectLivresDispo() {
        return $this->repository->selectLivresDispo();
    }


    public function marquerCommeRetourne($emprunt_id) {
    }
}