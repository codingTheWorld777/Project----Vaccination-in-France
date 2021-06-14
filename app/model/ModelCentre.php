<?php
require_once 'Model.php';

class ModelCentre {
    private $id, $label, $adresse;

    public function __construct($id = NULL, $label = NULL, $adresse  = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
            $this->label = $label;
            $this->adresse = $adresse;
        }
    }

    function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
    
    public function setLabel($label) {
        $this->label = $label;
    }

    public function getLabel() {
        return $this->label;
    }
    
    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function __toString() {
        return "$this->id";
    }

    public static function view() {
        //printf("<tr><td>%d</td><td>%s</td><td>%d</td></tr>", $this->getId(), $this->getLabel(), $this->getAdresse());
    }

    public static function getAllCenter() {
        try {
            $database = Model::getInstance();
            $query = "SELECT centre.label as centre_label, centre.adresse as centre_adresse FROM centre";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
        } catch (PDOException $e){
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getMany($query){
        try {
            $database = Model::getInstance();
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCentre");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM centre";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCentre");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getOne($label, $adresse) {
        try {
            $database = Model::getInstance();
            $query = "select * from centre where label = :label and adresse = :adresse";
            $statement = $database->prepare($query);
            $statement->execute([
                'label' => $label,
                'adresse' => $adresse
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCentre");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($label, $adresse) {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from centre";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into centre value (:id, :label, :adresse)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'label' => $label,
                'adresse' => $adresse
            ]);
            return $id;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }

    public static function deleteId($id){
        if (true) {
            $database = Model::getInstance();
            
            // Suppression d'un centre dans la table stock quand on supprime d'un vaccin
            // throw une erreur s'il y aucun centre avec ce centre_id dans le stock...
            $query = "DELETE FROM stock WHERE stock.centre_id = '$id'";
            $statement = $database->prepare($query);
            $statement->execute();
            
            // la même erreur qu'avant (dans la table rendezvous)
            $query = "DELETE FROM rendezvous WHERE rendezvous.centre_id = '$id'";
            $statement = $database->prepare($query);
            $statement->execute();
            
            $query = "DELETE FROM centre WHERE id = :id";
            $statement = $database->prepare($query);
            $statement->execute(['id' => $id]);
            return $id;
        } else throw new PDOException();
    }

    public static function update() {
        echo ("ModelCentre : update() TODO ....");
        return null;
    }

    public static function delete() {
        echo ("Modeladresse : delete() TODO ....");
        return null;
    }

}
?>
<!-- ----- fin ModelCentre -->
