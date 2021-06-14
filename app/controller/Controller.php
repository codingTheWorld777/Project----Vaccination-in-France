
<!-- ----- debut Controller -->
<?php

abstract class Controller {
    public static $additional_action;
    
    // --- page d'accueil -- fonction partagée entre les Controllers
    public static function accueil() {
        include 'config.php';
        $vue = $root . '/app/view/viewAccueil.php';
        
        if (DEBUG)
            echo ("Controller : accueil : vue = $vue");
        require ($vue);
    }

    // --- Liste des vaccins
    public static function vaccinReadAll() {}

    // Affiche un formulaire pour sélectionner un id qui existe
    public static function vaccinReadId($args) {}

    // Affiche un vaccin particulier (id)
    public static function vaccinReadOne() {}

    // Affiche le formulaire de creation d'un vaccin
    public static function vaccinCreate() {}

    // Affiche un formulaire pour récupérer les informations d'un nouveau vaccin.
    // La clé est gérée par le systeme et pas par l'internaute
    public static function vaccinCreated() {}
    
    // Affichage le résultat de suppression d'un vaccin par son id
    public static function vaccinDeleted() {}
}
?>
<!-- ----- fin Controller -->


