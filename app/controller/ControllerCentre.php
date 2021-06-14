<?php
require_once '../model/ModelCentre.php';
require_once '../controller/Controller.php';

class ControllerCentre extends Controller {
    
    public static function centreReadAll() {
        $results = ModelCentre::getAll();
        include 'config.php';
        $vue = $root . '/app/view/centre/viewAll.php';
        if (DEBUG)
            echo("ControllerCentre : centreReadAll : vue = $vue");
        require $vue;
    }

    public static function centreReadLabel($args) {
        $results = ModelCentre::getAllCenter();

        $target = $args['target'];

        include 'config.php';
        $vue = $root . '/app/view/centre/viewLabel.php';
        require $vue;
        return $target;
    }

    public static function centreDeleted() {
        $centre_label = explode(" : ", $_GET['label'])[0];
        $centre_adresse = explode(" : ", $_GET['label'])[1];
        $centre_id = ModelCentre::getOne($centre_label, $centre_adresse);
        if (count($centre_id) - 1 >= 0) $centre_id = $centre_id[count($centre_id) - 1];
        else $centre_id = NULL;
        
        try {
            if (!empty($centre_id)) $centre_id = $centre_id->getId();
            else {
                $results = ModelCentre::getAll();
                include 'config.php';
                $vue = $root.'/app/view/centre/viewNotDeleted.php';
                require $vue;
                return;
            }
            
            $centreDeleted_id = ModelCentre::deleteId($centre_id);
            $results = ModelCentre::getAll();
            include 'config.php';
            $vue = $root.'/app/view/centre/viewDeleted.php';
            require $vue;
        } catch (Exception $e){
            $results = ModelCentre::getAll();
            include 'config.php';
            $vue = $root.'/app/view/centre/viewNotDeleted.php';
            require $vue;
        }
    }

    public static function centreReadOne() {
        $centre_label = explode(" : ", $_GET['label'])[0];
        $centre_adresse = explode(" : ", $_GET['label'])[1];
        
        $results = ModelCentre::getOne($centre_label, $centre_adresse);

        include 'config.php';
        $vue = $root . '/app/view/centre/viewAll.php';
        require $vue;
    }

    public static function centreCreate() {
        include 'config.php';
        $vue = $root . '/app/view/centre/viewInsert.php';
        require $vue;
    }

    public static function centreCreated() {
        $condition1 = empty(trim($_GET['label'])) || empty(trim($_GET['adresse']));
        $condition2 = !empty(trim($_GET['label'])) && !empty(trim($_GET['adresse']));
        
        if ($condition1) $results = false;
        else if ($condition2) {
            // ajouter une validation des informations du formulaire
            $id = ModelCentre::insert(
                htmlspecialchars($_GET['label']), htmlspecialchars($_GET['adresse'])
            );
            
            $results = ModelCentre::getAll();
        }

        include 'config.php';
        $vue = $root . '/app/view/centre/viewInserted.php';
        require($vue);
    }
    
}