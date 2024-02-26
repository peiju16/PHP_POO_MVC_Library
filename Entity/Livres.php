<?php 

namespace Entity;

#[\AllowDynamicProperties]
class Livres {

    public $id;
    public $titre;
    public $auteur;
    public $annee_publication;
    public $disponible;

    
    public function __construct($id = null, $titre = null, $auteur = null, $annee_publication = null, $disponible = null) {

        $this->id = $id;
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->annee_publication = $annee_publication;
        $this->disponible = $disponible;
     
    }

}

?>