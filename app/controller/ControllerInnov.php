<?php
require_once '../model/ModelInnov.php';
require_once '../model/ModelPatient.php';
require_once '../controller/Controller.php';

class ControllerInnov extends Controller {
    
    // Liste de patients avec les doses complète
    public static function innov1() {
        $results = ModelInnov::patientFullDose();
        
        include 'config.php';
        $vue = $root . '/app/view/innov/innov1.php';
        if (DEBUG)
            echo("ControllerInnov : innov1 : vue = $vue");
        require $vue;
    }
    
    
    public static function innov2($args) {
        $target = $args['target'];
        $results = ModelInnov::getInfo();
        
        include 'config.php';
        $vue = $root . '/app/view/innov/innov2.php';
        if (DEBUG)
            echo("ControllerInnov : innov2 : vue = $vue");
        require $vue;
    }
    
    public static function getMap() {
        $target = NULL;
        $centre_adresse = explode(" : ", $_GET['centre'])[1];
        $patient_adresse = explode(" : ", $_GET['patient'])[1];
        $results = ModelInnov::ggMap($centre_adresse, $patient_adresse);
        
        include 'config.php';
        $vue = $root . '/app/view/innov/innov2.php';
        if (DEBUG)
            echo("ControllerInnov : innov2 : vue = $vue");
        require $vue;
    }
    
    
    public static function innov3() {
        $results = ModelPatient::patientReadDistinct();
        $results1 = ModelPatient::getPatientQuantityByAddress();
        
        // ----- Construction chemin de la vue
        include 'config.php';

        $vue = $root . '/app/view/patient/viewDistinct.php';
        if (DEBUG) echo ("ControllerPatient : patientReadAll : vue = $vue");
        require ($vue);
    }
    
}