<?php

namespace Repository;

class GenericRepository
{

    private $db;
    private $table;

    public function __construct($table){
        $this->table = $table;
    }

    public function getDb() {
        if(!$this->db) {
            try {
                $xml = simplexml_load_file("./Config/db.xml");
                try {
                    $options = [
                        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                        \PDO::ATTR_EMULATE_PREPARES   => false,
                    ];
                    $dsn = "mysql:host=". $xml->host .";dbname=". $xml->db .";charset=". $xml->charset;
                    $this->db = new \PDO($dsn, $xml->user, $xml->password, $options);

                } catch (\PDOException $e) {
                    throw new \Exception($e->getMessage());
                }
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
        return $this->db;
    }

    public function selectAll()
    {
        $sql = "SELECT * FROM " . $this->table .";";
        $stmt = $this->getDb()->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, "\Entity\\" . $this->table);

    }

    public function selectById($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = " . $id;
        $stmt = $this->getDb()->query($sql);
        $stmt->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, "\Entity\\" . $this->table); 
        $stmt->execute();
        return $stmt->fetch();
    }

    public function add()
    {

        // Construction de la chaîne SQL pour l'insertion
        $columns = implode(', ', array_keys($_POST)); // titre, auteur, annee_publication, disponible
        $placeholders = ':' . implode(', :', array_keys($_POST)); // :titre, :auteur, :annee_publication, :disponible

        // Préparation de la requête SQL
        // INSERT INTO livres (titre, auteur, annee_publication, disponible) VALUES (:titre, :auteur, :annee_publication, :disponible)";
        $sql = "INSERT INTO " . $this->table . " ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->getDb()->prepare($sql);

        // Liaison des paramètres
        foreach ($_POST as $index => &$value) {
            $stmt->bindParam(":{$index}", $value);
        }

        // $stmt->bindParam(':titre' => $value,)
        // $stmt->bindParam(':auteur' => $value,)
        // $stmt->bindParam(':annee_publication' => $value)

        // Exécution de la requête
        $stmt->execute();

        // Retourne l'identifiant de l'entité insérée
        return (int) $this->getDb()->lastInsertId();

    }

    public function delete($id)
    {
        $this->getDb()->exec("DELETE FROM " . $this->table . " WHERE id = " . $id);
    }

    public function update($id) {

        // Construction de la chaîne SQL pour la mise à jour
        $setPart = [];
        foreach ($_POST as $column => $value) {
            $setPart[] = "{$column} = :{$column}";
        }
        $setString = implode(', ', $setPart);

        // Préparation de la requête SQL
        $sql = "UPDATE " . $this->table . " SET {$setString} WHERE id = " . $id;
        $stmt = $this->getDb()->prepare($sql);

        // Liaison des paramètres
        foreach ($_POST as $column => &$value) {
            $stmt->bindParam(":{$column}", $value);
        }

        // Exécution de la requête
        return $stmt->execute();

    }
}

?>