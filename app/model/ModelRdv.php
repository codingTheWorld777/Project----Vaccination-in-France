<?php
require_once 'Model.php';

class ModelRdv {
    private $centre_id, $patient_id, $injection, $vaccin_id;

    public function __construct($centre_id = NULL, $patient_id = NULL, $injection = NULL, $vaccin_id = NULL) {
        if (!is_null($centre_id) && !is_null($patient_id) && !is_null($injection_id)) {
            $this->centre_id = $centre_id;
            $this->vaccin_id = $vaccin_id;
            $this->quantite = $quantite;
        }
    }

    public function __toString() {
        return "$this->id";
    }
    
    // Prendre la liste des rendez-vous
    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "SELECT patient.nom, patient.prenom, centre.label as centre_label, centre.adresse as centre_adresse, rendezvous.injection as injection, vaccin.label as vaccin_label "
                    . "FROM patient JOIN rendezvous ON patient.id = rendezvous.patient_id JOIN centre ON centre.id = rendezvous.centre_id "
                    . "JOIN vaccin ON vaccin.id = rendezvous.vaccin_id ORDER BY rendezvous.patient_id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return 0;
        }
    }
    
    // Prendre l'injection du patient
    public static function getInjection($patient_id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT rendezvous.injection as injection FROM rendezvous WHERE rendezvous.patient_id = '$patient_id'";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $results = $results[count($results) - 1]['injection'];
            return $results;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return 0;
        }
    }
    
    // Prendre les infos de patients
    public static function getPatient() {
        try {
            $database = Model::getInstance();
            $query = "SELECT id, nom, prenom, adresse FROM patient";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    // Proposer le vaccin pour les patients
    public static function getRdv($patient_id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT patient.nom, patient.prenom, centre.label as centre_label, centre.adresse as centre_adresse, rendezvous.injection as injection, vaccin.label as vaccin_label "
                    . "FROM patient JOIN rendezvous ON patient.id = rendezvous.patient_id JOIN centre ON centre.id = rendezvous.centre_id "
                    . "JOIN vaccin ON vaccin.id = rendezvous.vaccin_id WHERE rendezvous.patient_id = $patient_id ORDER BY rendezvous.injection";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    // Obtenir le nombre des doses d'un type du vaccin
    public static function getDoseNumberOfVaccin($vaccin_label) {
        try {
            $database = Model::getInstance();
            
            $query = "SELECT vaccin.doses as doses FROM vaccin WHERE vaccin.label = '$vaccin_label'";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC)[0]['doses'];
            
            return $results;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    // Trouver les centres où ils ont au moins une dose de vaccin
    public static function getActiveDoseFromCenter() {
        try {
            $database = Model::getInstance();
            $query = "SELECT DISTINCT centre.id as centre_id, centre.label as centre_label, centre.adresse as centre_adresse, SUM(stock.quantite) as quantite "
                    . "FROM centre JOIN stock ON centre.id = stock.centre_id GROUP BY centre_id HAVING SUM(stock.quantite) > 0 ";
            $statement = $database->prepare($query);
            $statement->execute();
            $activeCenter = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $activeCenter;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    // Utilisation: Trouver les centres de vaccination qui ont le vaccine que le patient a été vacciné
    public static function getCenterByVaccin($vaccin_label) {
        try {
            $database = Model::getInstance();
            $query = "SELECT DISTINCT centre.id as centre_id, centre.label as centre_label, centre.adresse as centre_adresse, SUM(stock.quantite) as quantite "
                    . "FROM centre JOIN stock ON centre.id = stock.centre_id JOIN vaccin ON vaccin.id = stock.vaccin_id "
                    . "WHERE vaccin.label = '$vaccin_label' GROUP BY centre_id HAVING SUM(stock.quantite) > 0 ";
            $statement = $database->prepare($query);
            $statement->execute();
            $activeCenter = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $activeCenter;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    // Définir un rendez-vous pour le patient
    public static function setRdv($centre_id, $centre_label, $patient_id, $injection) {
        if (!empty($centre_id) && !empty($centre_label) && !empty($patient_id)) {
            try {
                $database = Model::getInstance();

                // 1) Choisir un vaccin dans le centre choisi dont le vaccin de ce type a le nombre des doses le plus grand
                // On l'appelle 'VACCIN_G"
                $query = "SELECT MAX(stock.quantite) as quantite FROM stock WHERE stock.centre_id = '$centre_id'";
                $statement = $database->prepare($query);
                $statement->execute();
                $maxDose = $statement->fetchAll(PDO::FETCH_ASSOC)[0]['quantite'];
                
                
                // 2) On prend les infos du 'VACCIN_G' au centre choisi comme vaccin(id, label)... pour le proposer au patient
                // 2.1) Si ce patient a déjà un rendez-vous au centre de vaccination, on va trouver le nom du vaccin dans sa première dose
                // 2.2) Au contraire, on va trouver les centres qui ont le vaccin avec le nombre des doses positif pour ce patient
                // et on choisi le centre qui a le nombre des doses le plus grand.

                $query = "SELECT rendezvous.vaccin_id as vaccin_id FROM rendezvous WHERE rendezvous.patient_id = '$patient_id'";
                $statement = $database->prepare($query);
                $statement->execute();
                $vaccin_id = $statement->fetchAll(PDO::FETCH_ASSOC);
                
                // **** 2.1) Il y a pas de rendez-vous ****
                $vaccinInfo;
                if (empty($vaccin_id)) {
                    $query = "SELECT vaccin.id as vaccin_id, vaccin.label as vaccin_label, stock.quantite as quantite FROM vaccin JOIN stock "
                        . "ON vaccin.id = stock.vaccin_id WHERE stock.centre_id = '$centre_id' AND stock.quantite = '$maxDose'";
                    $statement = $database->prepare($query);
                    $statement->execute();
                    $vaccinInfo = $statement->fetchAll(PDO::FETCH_ASSOC)[0];
                    $vaccin_id = $vaccinInfo['vaccin_id'];
                   
                // **** 2.2) Au contraire... ****    
                } else {
                    $vaccin_id = $vaccin_id[0]['vaccin_id'];
                    
                    $query = "SELECT vaccin.id as vaccin_id, vaccin.label as vaccin_label, stock.quantite as quantite FROM vaccin JOIN stock "
                        . "ON vaccin.id = stock.vaccin_id WHERE stock.centre_id = '$centre_id' AND vaccin.id = '$vaccin_id'";
                    $statement = $database->prepare($query);
                    $statement->execute();
                    $vaccinInfo = $statement->fetchAll(PDO::FETCH_ASSOC)[0];
                }
                
                // pour savoir le nombre des doses resté d'un vaccin dans un centre
                // s'il y as plus de doses d'un vaccin dans un centre, on va notifier au patient
                // sinon, on va ajouter un rendez-vous pour ce patient et on met à jour le stock
                $quantite = intval($vaccinInfo['quantite']) - 1;  
                
                // 3) On va ajouter un rendez-vous pour ce patient. Ce patient est vacciné le vaccin choisi par le système
                // -> le nombre de doses de ce vaccin au centre choisi par le patient est donc le plus grand nombre
                if ($quantite >= 0) {
                    $query = "INSERT INTO rendezvous values (:centre_id, :patient_id, :injection, :vaccin_id)";
                    $statement = $database->prepare($query);
                    $test = $statement->execute([
                        'centre_id' => $centre_id,
                        'patient_id' => $patient_id,
                        'injection' => $injection,
                        'vaccin_id' => $vaccin_id
                    ]);
                } else return -1;

                // 4) On mis à jour le stock (en decrémentant la quantité des doses de ce 'VACCIN_G'
                $query = "UPDATE stock SET stock.quantite = '$quantite' WHERE stock.centre_id = '$centre_id' AND stock.vaccin_id = '$vaccin_id'";
                $statement = $database->prepare($query);
                $statement->execute();

                $results = [$centre_label, $vaccinInfo['vaccin_label']];

                return $results;
            
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
            
        } else return NULL;
    }
    
    // Ajouter vaccins aux centres pour le stock 
    public static function attributeVaccin() {
        try {
            $database = Model::getInstance();
            $result = array();
            
            $query = "SELECT distinct centre.label as centre_label FROM centre JOIN stock ON centre.id = stock.centre_id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results['centre'] = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            $query = "SELECT distinct vaccin.label as vaccin_label FROM vaccin JOIN stock ON vaccin.id = stock.vaccin_id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results['vaccin'] = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return $results;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    } 

    public static function insert($patient_id, $centre_id, $injection) {
        
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
<!-- ----- fin ModelRdv-->

