<?php
require_once 'Model.php';

class ModelPatient {
    private $id, $nom, $prenom, $adresse;

    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $adresse = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom= $prenom;
            $this->adresse = $adresse;
        }
    }

    function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
    
    public function setNom($nom) {
        $this->nom = $nom;
    }
    
    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }
    
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
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
        //printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>", $this->getId(), $this->getNom(), $this->getPreom(), $this->getAdresse());
    }

    public static function getAllId() {
        try {
            $database = Model::getInstance();
            $query = "SELECT id, nom, prenom, adresse FROM patient ORDER BY id";
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
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPatient");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM patient";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPatient");
            return $results;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getOne($id) {
        try {
            $database = Model::getInstance();
            $query = "select * from patient where id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPatient");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function patientReadDistinct() {
        try {
            $database = Model::getInstance();
            $query = "SELECT DISTINCT adresse FROM patient";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPatient");
            return $results;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    // Affiche la quantité de patients dans chaque région
    public static function getPatientQuantityByAddress() {
        try {
            $database = Model::getInstance();
            $distinctAddresses = ModelPatient::patientReadDistinct();
            $quantityByAddress = array();
            
            foreach ($distinctAddresses as $adresse) {
                $adresse = $adresse->getAdresse();
                $query = "select count(adresse) as quantite from patient where adresse='$adresse'";
                $statement = $database->prepare($query);
                $statement->execute();
                $results = $statement->fetch(PDO::FETCH_BOTH);
                array_push($quantityByAddress, $results['quantite']);
            }
            
            return $quantityByAddress;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($nom, $prenom, $adresse) {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from patient";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into patient value (:id, :nom, :prenom, :adresse)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'adresse' => $adresse
            ]);
            return $id;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }

    public static function deleteId($patient_id){
        try{
            $database = Model::getInstance();
            
            // Supprimer un patient dans la table rendezvous (s'il y existe)
            $query = "DELETE FROM rendezvous WHERE patient_id = :patient_id";
            $statement = $database->prepare($query);
            $statement->execute(['patient_id' => $patient_id]);
            
            // Supprimer un patient dans la table patient 
            $query = "DELETE FROM patient WHERE id = :id";
            $statement = $database->prepare($query);
            $statement->execute(['id' => $patient_id]);
            return $patient_id;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function update() {
        echo ("ModelPatient : update() TODO ....");
        return null;
    }

    public static function delete() {
        echo ("ModelPatient : delete() TODO ....");
        return null;
    }

}
?>
<!-- ----- fin ModelPatient -->


