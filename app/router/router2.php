<!-- ----- debut Router2 -->
<?php
require('../controller/ControllerSearch.php');
require('../controller/ControllerVaccin.php');
require('../controller/ControllerCentre.php');
require('../controller/ControllerPatient.php');
require('../controller/ControllerStock.php');
require('../controller/ControllerRdv.php');
require('../controller/ControllerInnov.php');

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

//Modification du routeur pour prendre en compte l'ensemble des paramètres
$action = $param['action'];
//On supprime l'élément action de la structure
unset($param['action']);

//Tout ce qui reste sont les arguments
$args = $param;


// --- Liste des méthodes autorisées
switch ($action) {
    case "vaccinReadAll" :
    case "vaccinReadOne" :
    case "vaccinReadLabel" :
    case "vaccinCreate" :
    case "vaccinCreated" :
    case "vaccinDeleted":
    case "vaccinModifyDose":
    case "vaccinUpdateDose":
        ControllerVaccin::$action($args);
        break;
    
    case "centreReadAll" :
    case "centreReadOne" :
    case "centreReadLabel" :
    case "centreCreate" :
    case "centreCreated" :
    case "centreReadDistinct" :
    case "centretityByLabel":
    case "centreDeleted":
        ControllerCentre::$action($args);
        break;
    
    case "patientReadAll" :
    case "patientReadOne" :
    case "patientReadId" :
    case "patientCreate" :
    case "patientCreated" :
    case "patientReadDistinct" :
    case "quantityByAddress" :
    case "patientDeleted":
        ControllerPatient::$action($args);
        break;
    
    case "stockReadDosesByVaccinByCenter" :
    case "stockReadDosesByCenter" : 
    case "stockAdd" :
    case "stockAdded" :
    case "stockDeleted" :
        ControllerStock::$action($args);
        break;
    
    case "rdvReadPatient" :
    case "rdvPropos" : 
    case "setRdv" :
    case "rdvReadAll" :
        ControllerRdv::$action($args);
        break;

    case "doc1" :
        include "../../public/documentation/innovation1.php";
        break;
    case "doc2" :
        include "../../public/documentation/innovation2.php";
        break;
    case "doc3" :
        include "../../public/documentation/innovation3.php";
        break;
    case "doc4" :
        include "../../public/documentation/innovation4.php";
        break;
    case "pointDeVue" :
        include "../../public/documentation/monProjet.php";
        break;
    
    case "innov1" :
    case "innov2" :
    case "getMap" :
    case "innov3" :
        ControllerInnov::$action($args);
        break;

    case "searchVaccin" :
    case "searchCentre" :
    case "searchPatient" :
    case "searchStock" :
        if (isset($_GET['searching'])){
            $args = $_GET['searching'];
        }
        ControllerSearch::$action($args);
        break;

    // Tache par défaut
    default:
        $action = "accueil";
        ControllerVaccin::$action($args);
        break;
}
?>
<!-- ----- Fin Router2 -->

