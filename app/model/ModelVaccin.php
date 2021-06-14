
<!-- ----- debut ModelVaccin -->
<?php
require_once 'Model.php';

class ModelVaccin {
    private $id, $label, $doses;

    // pas possible d'avoir 2 constructeurs
    public function __construct($id = NULL, $label = NULL, $doses = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->id = $id;
            $this->label = $label;
            $this->doses = $doses;
        }
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLabel($label) {
        $this->label = $label;
    }

    function setDoses($doses) {
        $this->doses = $doses;
    }

    function getId() {
        return $this->id;
    }

    function getLabel() {
        return $this->label;
    }

    function getDoses() {
        return $this->doses;
    }

    public function __toString() {
        return "$this->id";
    }

    // Persistance .......


    public static function view() {
     //printf("<tr><td>%d</td><td>%s</td><td>%d</td><td>%.00f</td></tr>", $this->getId(), $this->getLabel(), $this->getDoses());
    }

    // retourne une liste des id
    public static function getAllId() {
        try {
            $database = Model::getInstance();
            $query = "select id from vaccin order by id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            return $results;

        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // retourne une liste de vaccin_label
    public static function getAllLabel() {
        try {
            $database = Model::getInstance();
            $query = "select label from vaccin order by id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            return $results;

        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getMany($query) {
        try {
            $database = Model::getInstance();
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelVaccin");
            return $results;

        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "select * from vaccin";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelVaccin");
            return $results;

        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getOne($label) {
        try {
            $database = Model::getInstance();
            $query = "select * from vaccin where label = :label";
            $statement = $database->prepare($query);
            $statement->execute([
              'label' => $label
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelVaccin");
            return $results;

        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($label, $doses) {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from vaccin";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into vaccin value (:id, :label, :doses)";
            $statement = $database->prepare($query);
            $statement->execute([
              'id' => $id,
              'label' => $label,
              'doses' => $doses
            ]);
            return $id;

        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }

    public static function deleteLabel($vaccin_label){
        if (true){
            $database = Model::getInstance();
            $query = "SELECT vaccin.id FROM vaccin WHERE vaccin.label = '$vaccin_label'";
            $statement = $database->prepare($query);
            $statement->execute();
            $statement = $statement->fetchAll(PDO::FETCH_CLASS, "ModelVaccin")[0];
            if (!empty($statement)) $id = $statement->getId();
            else return;
            
            // Suppression d'un vaccin dans la table stock quand on supprime d'un vaccin
            // throw une erreur s'il y aucun vaccin avec cet id dans le stock...
            $query = "DELETE FROM stock WHERE stock.vaccin_id = '$id'";
            $statement = $database->prepare($query);
            $statement->execute();
            
            // la même erreur qu'avant (dans la table rendezvous)
            $query = "DELETE FROM rendezvous WHERE rendezvous.vaccin_id = '$id'";
            $statement = $database->prepare($query);
            $statement->execute();

            // Suppression d'un vaccin dans la table vaccin
            $query = "DELETE FROM vaccin WHERE id = '$id'";
            $statement = $database->prepare($query);
            $statement->execute();
            
            return $vaccin_label;

        } else {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function updateDose($vaccin_label, $quantite) {
        $database = Model::getInstance();
        
        // Ajouter les doses sur les base des donnees
        $query = "SELECT doses FROM vaccin WHERE label = '$vaccin_label'";
        $statement = $database->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        $doses = $quantite + intval($result['doses']);
        if ($doses < 0) $doses = 0;
        
        // Mise à jour les doses après les avoir modifiées
        try {
            $query = "UPDATE vaccin SET doses = '$doses' WHERE label = '$vaccin_label'";
            $statement = $database->query($query);
            
        } catch (PDOException $ex) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        }

    }
        

    public static function update() {
        echo ("ModelVaccin : update() TODO ....");
        return null;
    }

    public static function delete() {
        echo ("ModelVaccin : delete() TODO ....");
        return null;
    }

}
?>
<!-- ----- fin ModelVaccin -->
