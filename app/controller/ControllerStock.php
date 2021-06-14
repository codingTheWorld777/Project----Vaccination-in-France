<?php
require_once '../model/ModelStock.php';
require_once '../controller/Controller.php';

class ControllerStock extends Controller {
    public static function stockReadDosesByVaccinByCenter() {
        $results = ModelStock::getDosesByVaccinByCenter();
        
        include 'config.php';
        $vue = $root . '/app/view/stock/viewDoseByVaccinByCenter.php';
        if (DEBUG)
            echo("ControllerStock : stockReadDosesByVaccinByCenter : vue = $vue");
        require $vue;
    }
    
    public static function stockReadDosesByCenter() {
        $results = ModelStock::getCenterAndDose();
        $stockCenters = $results[0];
        $numberOfDosesByCenter =  $results[1];
        
        include 'config.php';
        $vue = $root . '/app/view/stock/viewCentreDose.php';
        if (DEBUG)
            echo("ControllerStock : stockReadCentreDose : vue = $vue");
        require $vue;
    }
    
    
    // Ajouter les doses de vaccins aux centres de vaccination pour le stock
    public static function stockAdd($args) {
        $results = ModelStock::attributeVaccin();
            
        $target = $args['target'];
        
        include 'config.php';
        $vue = $root . '/app/view/stock/viewStockAdd.php';
        if (DEBUG)
            echo("ControllerStock : stockAdd : vue = $vue");
        require $vue;
    }
    
    public static function stockAdded() {
        $centre_label = explode(" : ", $_GET['centre_label'])[0];
        $centre_adresse = explode(" : ", $_GET['centre_label'])[1];
        $vaccin_label = $_GET['vaccin_label'];
        $vaccin_add = $_GET['vaccin_add'];
            
        $stockAdded = ModelStock::addVaccin($centre_label, $centre_adresse, $vaccin_label, $vaccin_add);
        $results = ModelStock::getDosesByVaccinByCenter();
            
        include 'config.php';
        $vue = $root . '/app/view/stock/viewDoseByVaccinByCenter.php';
        if (DEBUG)
            echo("ControllerStock : stockAdded : vue = $vue");
        require $vue;
    }
    
    // Suppression d'un stock
    public static function stockDeleted() {
        $target = $_GET['target'];
        $centre_label = explode(" : ", $_GET['centre_label'])[0];
        $centre_adresse = explode(" : ", $_GET['centre_label'])[1];
        $vaccin_label = $_GET['vaccin_label'];
        $centre_id = ModelStock::getCentreId($centre_label, $centre_adresse);
        $vaccin_id = ModelStock::getVaccinId($vaccin_label);
        
        $delete_operation = ModelStock::deleteStock($centre_id, $vaccin_id);
        $results = ModelStock::getDosesByVaccinByCenter();
        
        include 'config.php';
        $vue = $root . '/app/view/stock/viewStockDeleted.php';
        if (DEBUG)
            echo("ControllerStock : stockAdded : vue = $vue");
        require $vue;
    }
}