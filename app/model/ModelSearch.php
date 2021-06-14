<?php
require_once 'Model.php';

class ModelSearch {
    public static function getSearchVaccin($args){
        $labelSearched = $args;

        try {
            $database = Model::getInstance();
            $query = "select * from vaccin where label = :label";
            $statement = $database->prepare($query);
            $statement->execute(['label' => $labelSearched] );
            $results = $statement->fetchAll(PDO::FETCH_CLASS, 'ModelVaccin');

            return $results;
            
        } catch (PDOException $e){
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getSearchCentre($args){
        $centreSearched = $args;

        try {
            $database = Model::getInstance();
            $query = "select * from centre where label = :label";
            $statement = $database->prepare($query);
            $statement->execute(['label' => $centreSearched]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, 'ModelCentre');

            return $results;
            
        } catch (PDOException $e){
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function getSearchPatient($args){
        $patientSearched = $args;

        try {
            $database = Model::getInstance();
            $query = "select * from patient where nom = :nom";
            $statement = $database->prepare($query);
            $statement->execute(['nom' => $patientSearched]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, 'ModelPatient');

            return $results;
            
        } catch (PDOException $e){
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function getSearchStock($args){
        $vaccin_label = $args;

        try {
            $database = Model::getInstance();
            $query = "SELECT vaccin.label as vaccin_label, centre.label as centre_label, stock.quantite as quantite FROM centre JOIN stock "
                    . "ON centre.id = stock.centre_id JOIN vaccin ON vaccin.id = stock.vaccin_id WHERE vaccin.label = :vaccin_label";
            $statement = $database->prepare($query);
            $statement->execute(['vaccin_label' => $vaccin_label]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $results;
            
        } catch (PDOException $e){
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}