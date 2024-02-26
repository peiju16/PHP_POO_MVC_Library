<?php

namespace Entity;

#[\AllowDynamicProperties]
class Emprunts {
    public $id;
    public $livre_id;
    public $date_emprunt;
    public $date_retour;

    public function __construct($id = null, $livre_id = null, $date_emprunt = null, $date_retour = null) {
        $this->id = $id;
        $this->livre_id = $livre_id;
        $this->date_emprunt = $date_emprunt;
        $this->date_retour = $date_retour;
    }

 
}

?>