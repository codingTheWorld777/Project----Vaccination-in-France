<!-- ----- debut ControllerVaccin -->
<?php
require_once '../model/ModelVaccin.php';
require_once '../controller/Controller.php';

class ControllerVaccin extends Controller {
    
    // --- Liste des vaccins
    public static function vaccinReadAll() {
        $results = ModelVaccin::getAll();
        
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/vaccin/viewAll.php';
        if (DEBUG)
            echo("ControllerVaccin : vaccinReadAll : vue = $vue");
        require($vue);
    }

    // Affiche un formulaire pour sélectionner un id qui existe
    public static function vaccinReadLabel($args) {
        $results = ModelVaccin::getAllLabel();

        $target = $args['target'];

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/vaccin/viewLabel.php';
        require($vue);
        return $target;
    }

    public static function vaccinDeleted() {
        $vaccin_label = $_GET['label'];
        try {
            $label_vaccinDeleted = ModelVaccin::deleteLabel($vaccin_label);
            $results = ModelVaccin::getAll();
            include 'config.php';
            $vue = $root.'/app/view/vaccin/viewDeleted.php';
            require $vue;
            
        } catch (PDOException $e){
            $results = ModelVaccin::getAll();
            include 'config.php';
            $vue = $root.'/app/view/vaccin/viewNotDeleted.php';
            require $vue;
        }
    }

    // Affiche un vaccin particulier (id)
    public static function vaccinReadOne() {
        $vaccin_label = $_GET['label'];
        $results = ModelVaccin::getOne($vaccin_label);

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/vaccin/viewAll.php';
        require($vue);
    }

    // Affiche le formulaire de creation d'un vaccin
    public static function vaccinCreate() {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/vaccin/viewInsert.php';
        require($vue);
    }

    // Affiche un formulaire pour récupérer les informations d'un nouveau vaccin.
    // La clé est gérée par le systeme et pas par l'internaute
    public static function vaccinCreated() {
        $condition1 = empty(trim($_GET['label'])) || empty(trim($_GET['doses']));
        $condition2 = !empty(trim($_GET['label'])) && !empty(trim($_GET['doses']));
        
        if ($condition1) $results = false;
        else if ($condition2) {
            // ajouter une validation des informations du formulaire
            $id = ModelVaccin::insert(
                htmlspecialchars($_GET['label']), htmlspecialchars($_GET['doses'])
            );
            
            $results = ModelVaccin::getAll();
        }
        
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/vaccin/viewInserted.php';
        require($vue);
    }
    
    
    public static function vaccinModifyDose() {
        $results = ModelVaccin::getAll();

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/vaccin/viewModifyDose.php';
        require($vue);
    }
    
    public static function vaccinUpdateDose() {
        $vaccin_label = $_GET['label'];
        $quantite = $_GET['quantite'];
       
        ModelVaccin::updateDose($vaccin_label, $quantite);
        $results = ModelVaccin::getAll();

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/vaccin/viewUpdateDose.php';
        require($vue);
    }

}

?>
<!-- ----- fin ControllerVaccin -->


