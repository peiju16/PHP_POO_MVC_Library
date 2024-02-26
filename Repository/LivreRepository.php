<?php

    namespace Repository;
    class LivreRepository extends GenericRepository implements IRepository {

        private static $table = "Livres";
        public function __construct() {
            parent::__construct(self::$table);
        }

        // left join
        public function getAllEmpruntAndBooks() {

        }

        public function deleteEmprunt($id) {
            $this->getDb()->exec("DELETE FROM emprunts WHERE livre_id = " . $id);
        }

        public function updateEmprunt($id) {

     
            $sql = "INSERT INTO emprunts (livre_id, date_emprunt) VALUE ('$id', 'NOW()')" ;
            $stmt = $this->getDb()->prepare($sql);
    
            $stmt->execute();

    

        }


    }





?>