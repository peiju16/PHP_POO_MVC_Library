<?php

   namespace Repository;

    class EmpruntRepository extends GenericRepository implements IRepository {

        private static $table = "Emprunts";
        public function __construct() {
            parent::__construct(self::$table);
        }


        // left join
        public function getAllEmpruntAndBooks() {

        }

        public function selectAll()
        {
            $sql = "SELECT * FROM emprunts e INNER JOIN livres l ON e.livre_id = l.id ";
            $stmt = $this->getDb()->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, "\Entity\Emprunts");
    
        }

        public function selectLivresDispo() {
            $sql = "SELECT * FROM livres WHERE disponible = True";
            $stmt = $this->getDb()->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, "\Entity\Livres");
        }

        public function borrowBook($livre_id) {
            $sql = "UPDATE livres SET disponible = False WHERE id = " . $livre_id;
            $this->getDb()->exec($sql);
        }
        
    }





?>