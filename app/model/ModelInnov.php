<!-- ----- debut ModelInnov -->
<?php
require_once 'Model.php';

class ModelInnov {
    
    public static function patientFullDose() {
        try {
            $database = Model::getInstance();
            $query = "SELECT patient.nom, patient.prenom, vaccin.label as vaccin_label, vaccin.doses, centre.label as centre_label, centre.adresse as centre_adresse, rendezvous.injection "
                    . "FROM patient, vaccin, centre, rendezvous WHERE patient.id = rendezvous.patient_id AND vaccin.id = rendezvous.vaccin_id "
                    . "AND centre.id = rendezvous.centre_id AND vaccin.doses = rendezvous.injection";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function getInfo() {
        try {
            $database = Model::getInstance();
            $results = array();
            
            $query = "SELECT * FROM centre ORDER BY centre.id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results['centre'] = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            $query = "SELECT * FROM patient ORDER BY patient.id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results['patient'] = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return $results;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function ggMap($centre_adresse, $patient_adresse) {
        $url = "https://www.google.com/maps/dir/" . $patient_adresse . "/" . $centre_adresse;
        return $url;
    }
}
?>
<!-- ----- fin ModelInnov -->
