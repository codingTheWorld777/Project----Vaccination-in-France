<?php
require_once '../model/ModelRdv.php';
require_once '../controller/Controller.php';

class ControllerRdv extends Controller {
    
    public static function rdvReadAll() {
        $results = ModelRdv::getAll();
        
        include 'config.php';
        $vue = $root . '/app/view/rdv/viewAll.php';
        if (DEBUG)
            echo("ControllerRdv : rdvReadAll : vue = $vue");
        require $vue;
    }
    
    public static function rdvReadPatient($args) {
        $target = $args['target'];
        $results = ModelRdv::getPatient();
        
        include 'config.php';
        $vue = $root . '/app/view/rdv/viewPatient.php';
        if (DEBUG)
            echo("ControllerRdv : rdvReadPatient : vue = $vue");
        require $vue;
    }
    
    // Voir le rendez-vous vacciné d'un patient
    public static function rdvPropos() {
        $patientInfo = $_GET['patientInfo'];
        $patient_id = explode(" : ", $_GET['patientInfo'])[0];
        
        $results = ModelRdv::getRdv($patient_id);                // il faut vérifier s'elle est nulle ou pas
        $activeCenter = ModelRdv::getActiveDoseFromCenter();    // cela pour proposer ce qui n'a pas encore un rendez-vous
        
        $numberOfDose; $patient_injection;  $centerByVaccin;   // celles pour bien savoir si le patient doit vacciner encore une fois ou pas
        if (!empty($results)) {
            $numberOfDose =  ModelRdv::getDoseNumberOfVaccin($results[0]['vaccin_label']); 
            $patient_injection = $results[count($results) - 1]['injection'];
            $centerByVaccin = ModelRdv::getCenterByVaccin($results[0]['vaccin_label']);
        }
        
        include 'config.php';
        $vue = $root . '/app/view/rdv/viewRdvPropos.php';
        if (DEBUG)
            echo("ControllerRdv : rdvPropos : vue = $vue");
        require $vue;
    }
    
    // Définir un rendez-vous pour le patient
    public static function setRdv() {
        $patient_id = $_GET['patientId'];
        $centre_id = explode(" : ", $_GET['centreInfo'])[0];
        $centre_label = explode(" : ", $_GET['centreInfo'])[1];
        $centre_adresse = explode(" : ", $_GET['centreInfo'])[2];
        $injection = intval(ModelRdv::getInjection($patient_id)) + 1;
        
        $results = ModelRdv::setRdv($centre_id, $centre_label, $patient_id, $injection);
        
        include 'config.php';
        $vue = $root . '/app/view/rdv/viewSetRdv.php';
        if (DEBUG)
            echo("ControllerRdv : setRdv : vue = $vue");
        require $vue;
    }     
}