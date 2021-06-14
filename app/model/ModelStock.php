<?php
require_once 'Model.php';

class ModelStock {
    private $vaccin_id, $centre_id, $quantite;

    public function __construct($centre_id = NULL, $vaccin_id = NULL, $quantite = NULL) {
        if (!is_null($centre_id) && !is_null($vaccin_id)) {
            $this->centre_id = $centre_id;
            $this->vaccin_id = $vaccin_id;
            $this->quantite = $quantite;
        }
    }

    public static function getVaccinId($vaccin_label) {
        try {
            $database = Model::getInstance();
            $query = "SELECT id FROM vaccin WHERE label = '$vaccin_label'";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC)[0]['id'];
            return $results;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getCentreId($centre_label, $centre_adresse) {
        try {
            $database = Model::getInstance();
            $query = "SELECT id FROM centre WHERE label = '$centre_label' AND adresse = '$centre_adresse'";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC)[0]['id'];
            return $results;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public function getQuantite() {
        return $this->quantite;
    }

    public function __toString() {
        return "$this->id";
    }

    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM stock";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function getDosesByVaccinByCenter() {
        try {
            $database = Model::getInstance();
            $query = "SELECT vaccin.label as vaccin_label, centre.label as centre_label, centre.adresse as centre_adresse, stock.quantite as doses FROM vaccin "
                    . "JOIN stock ON vaccin.id = stock.vaccin_id JOIN centre ON centre.id = stock.centre_id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function getStockCentre() {
        try {
            $database = Model::getInstance();
            $query = "SELECT DISTINCT centre.label, centre.adresse FROM centre JOIN stock ON centre.id = stock.centre_id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function getCenterAndDose() {
        try {
            $database = Model::getInstance();
            
            $stockCenters = ModelStock::getStockCentre();
            $numberOfDosesByCenter = []; 
            $results;
            
            foreach ($stockCenters as $centre) {
                $label = $centre['label'];
                $adresse = $centre['adresse'];
                
                $query = "SELECT SUM(stock.quantite) as quantite FROM centre JOIN stock ON centre.id = stock.centre_id "
                        . "WHERE centre.label='$label' AND centre.adresse = '$adresse'";
                $statement = $database->prepare($query);
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                print_r($results);
                array_push($numberOfDosesByCenter, $results[0]['quantite']);
            }
            
            $results = array($stockCenters, $numberOfDosesByCenter);
            return $results;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    // Ajouter vaccins aux centres pour le stock 
    public static function attributeVaccin() {
        try {
            $database = Model::getInstance();
            $result = array();
            
            $query = "SELECT centre.label as centre_label, centre.adresse as centre_adresse FROM centre";
            $statement = $database->prepare($query);
            $statement->execute();
            $results['centre'] = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            $query = "SELECT vaccin.label as vaccin_label FROM vaccin";
            $statement = $database->prepare($query);
            $statement->execute();
            $results['vaccin'] = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return $results;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function addVaccin($centre_label, $centre_adresse, $vaccin_label, $vaccin_add) {
        try {
            $database = Model::getInstance();
            $result = array();
            
            
            // On a besoin de centre_id et de vaccin_id pour pouvoir modifier la table 'stock'
            // 1) Si le centre ou le vaccin n'est pas dans le stock, il faut insérer un nouveau stock 
            // avec centre_id = max(centre_id) + 1, le même pour vaccin_id
            // 2) Sinon, on a le centre_id et le vaccin_id dans le stock pour le modifier...
            
            // -> check 'centre_id'
            $query = "SELECT DISTINCT stock.centre_id FROM centre JOIN stock ON centre.id = stock.centre_id "
                    . "WHERE centre.label = '$centre_label' AND centre.adresse = '$centre_adresse'";
            $statement = $database->prepare($query);
            $statement->execute();
            $centre_id = $statement->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($centre_id)) $centre_id = $centre_id[0]['centre_id'];
            else {
                $query = "SELECT centre.id as centre_id from centre WHERE centre.label = '$centre_label' AND centre.adresse = '$centre_adresse'";
                $statement = $database->prepare($query);
                $statement->execute();
                $centre_id = $statement->fetchAll(PDO::FETCH_ASSOC)[0]['centre_id'];
            }
            echo("centre_id : $centre_id");
            // -> check 'vaccin_id'
            $query = "SELECT DISTINCT stock.vaccin_id FROM vaccin JOIN stock ON vaccin.id = stock.vaccin_id "
                    . "WHERE vaccin.label = '$vaccin_label'";
            $statement = $database->prepare($query);
            $statement->execute();
            $vaccin_id = $statement->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($vaccin_id)) $vaccin_id = $vaccin_id[0]['vaccin_id'];
            else {
                $query = "SELECT vaccin.id as vaccin_id from vaccin WHERE vaccin.label = '$vaccin_label'";
                $statement = $database->prepare($query);
                $statement->execute();
                $vaccin_id = $statement->fetchAll(PDO::FETCH_ASSOC)[0]['vaccin_id'];
            }
            echo("vaccin_id : $vaccin_id");
            
            // Après avoir pris le centre_id et le vaccin_id, on veut prendre la quantité des doses d'un vaccin dans le stock
            // 1) Si le centre_id ou le vaccin_id (ou les deux) n'est pas dans le stock, on met stock.quantite = 0
            // 2) Sinon, on ajoute le vaccin_add dans le stock(centre_id, vaccin_id) et on met à jour le stock
            $query = "SELECT stock.quantite as quantite FROM stock "
                    . "WHERE stock.centre_id = '$centre_id' AND stock.vaccin_id = '$vaccin_id'";
            $statement = $database->query($query);
            $statement->execute();
            $quantite = $statement->fetchAll(PDO::FETCH_ASSOC)[0]['quantite'];
            // 1)
            if (!empty($quantite)) {
                $quantite = intval($quantite) + intval($vaccin_add);
                $query = "UPDATE stock SET stock.quantite = '$quantite' WHERE stock.centre_id = '$centre_id' AND stock.vaccin_id = '$vaccin_id'";
                $statement = $database->query($query);
                $statement->execute();
            } 
            // 2)
            else {
                $quantite = $vaccin_add;
                $query = "INSERT INTO stock VALUES ('$centre_id', '$vaccin_id', '$quantite')";
                $statement = $database->query($query);
                $statement->execute();
            }
            
            return array("centre_label" => $centre_label, "centre_adresse" => $centre_adresse, "vaccin_label" => $vaccin_label, 
                        "vaccin_add" => $vaccin_add, "quantite" => $quantite);
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    } 

    public static function insert($label, $adresse) {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from centre";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into centre value (:id, :label, :adresse)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'label' => $label,
                'adresse' => $adresse
            ]);
            return $id;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }

    public static function deleteStock($centre_id, $vaccin_id) {
        if (true) {
            $database = Model::getInstance();
            
            $query = "DELETE FROM rendezvous WHERE rendezvous.centre_id = '$centre_id' AND rendezvous.vaccin_id = '$vaccin_id'";
            $results = $database->exec($query);
            
            $query = "DELETE FROM stock WHERE stock.centre_id = '$centre_id' AND stock.vaccin_id = '$vaccin_id'";
            $results = $database->exec($query);

            return $results;
            
        } else throw new PDOException();
    }

    public static function update() {
        echo ("ModelCentre : update() TODO ....");
        return null;
    }

    public static function delete() {
        echo ("Modeladresse : delete() TODO ....");
        return null;
    }

}
?>
<!-- ----- fin ModelStock -->
