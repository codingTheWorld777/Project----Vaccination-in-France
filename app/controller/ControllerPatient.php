<?php
require_once '../model/ModelPatient.php';
require_once '../controller/Controller.php';

class ControllerPatient extends Controller {
    
    public static function patientReadAll() {
        $results = ModelPatient::getAll();
        include 'config.php';
        $vue = $root . '/app/view/patient/viewAll.php';
        if (DEBUG)
            echo("ControllerPatient : patientReadAll : vue = $vue");
        require $vue;
    }

    public static function patientReadId($args) {
        $results = ModelPatient::getAllId();

        $target = $args['target'];

        include 'config.php';
        $vue = $root . '/app/view/patient/viewId.php';
        require $vue;
        return $target;
    }

    public static function patientDeleted() {
        $patient_id = explode(" : ", $_GET['patientInfo'])[0];
        try {
            $id_patientDeleted = ModelPatient::deleteId($patient_id);
            $results = ModelPatient::getAll();
            include 'config.php';
            $vue = $root.'/app/view/patient/viewDeleted.php';
            require $vue;
        } catch (PDOException $e){
            $results = ModelPatient::getAll();
            include 'config.php';
            $vue = $root.'/app/view/patient/viewNotDeleted.php';
            require $vue;
        }
    }

    public static function patientReadOne() {
        $patient_id = explode(" : ", $_GET['patientInfo'])[0];
        $results = ModelPatient::getOne($patient_id);

        include 'config.php';
        $vue = $root . '/app/view/patient/viewAll.php';
        require $vue;
    }

    public static function patientCreate() {
        include 'config.php';
        $vue = $root . '/app/view/patient/viewInsert.php';
        require $vue;
    }

    public static function patientCreated() {
        $condition1 = empty(trim($_GET['nom'])) || empty(trim($_GET['prenom'])) || empty(trim($_GET['adresse']));
        $condition2 = !empty(trim($_GET['nom'])) && !empty(trim($_GET['prenom'])) && !empty(trim($_GET['adresse']));
        
        if ($condition1) $results = false;
        else if ($condition2) {
            // ajouter une validation des informations du formulaire
            $id = ModelPatient::insert(
                htmlspecialchars($_GET['nom']), htmlspecialchars($_GET['prenom']), htmlspecialchars($_GET['adresse'])
            );
            
            $results = ModelPatient::getAll();
        }

        include 'config.php';
        $vue = $root . '/app/view/patient/viewInserted.php';
        require($vue);
    }
    
    public static function patientReadDistinct() {
        $results = ModelPatient::patientReadDistinct();
        $results1 = NULL;

        // ----- Construction chemin de la vue
        include 'config.php';

        $vue = $root . '/app/view/patient/viewDistinct.php';
        if (DEBUG) echo ("ControllerPatient : patientReadAll : vue = $vue");
        require ($vue);
    }
    
    // Affiche le nombre de patients par son adresse
    public static function quantityByAddress() {
        $results = ModelPatient::patientReadDistinct();
        $results1 = ModelPatient::getPatientQuantityByAddress();
        
        // ----- Construction chemin de la vue
        include 'config.php';

        $vue = $root . '/app/view/patient/viewDistinct.php';
        if (DEBUG) echo ("ControllerPatient : patientReadAll : vue = $vue");
        require ($vue);
    }
}