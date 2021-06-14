<?php
require_once '../model/ModelSearch.php';

class ControllerSearch {
    
    // Recherche 'vaccin'
    public static function searchVaccin($args) {
        $results = ModelSearch::getSearchVaccin($args);
        $resultsLength = count($results);

        include 'config.php';
        $vue = $root . '/app/view/search/searchResultVaccin.php';
        require $vue;
    }

    // Recherche 'centre' par son label
    public static function searchCentre($args) {
        $results = ModelSearch::getSearchCentre($args);
        $resultsLength = count($results);

        include 'config.php';
        $vue = $root . '/app/view/search/searchResultCentre.php';
        require $vue;
    }
    
    // Recherche 'patient' par son nom
    public static function searchPatient($args) {
        $results = ModelSearch::getSearchPatient($args);
        $resultsLength = count($results);

        include 'config.php';
        $vue = $root . '/app/view/search/searchResultPatient.php';
        require $vue;
    }

    // Recherche 'stock' selon le nom du vaccin
    public static function searchStock($args) {
        $results = ModelSearch::getSearchStock($args);
        $resultsLength = count($results);

        include 'config.php';
        $vue = $root . '/app/view/search/searchResultStock.php';
        require $vue;
    }
}