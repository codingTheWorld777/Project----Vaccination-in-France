<?php
include($root . '/app/controller/config.php');
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax parallax2">
        <div class="titre">
            Stock des vaccins ...
        </div>
    </div>
    
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        
        <?php
        if (!empty($stockAdded)) {
            if ($stockAdded != -1) {
                echo("<h3 style='display: block;'>Vous avez ajouté {$stockAdded['vaccin_add']} dose(s) de vaccin {$stockAdded['vaccin_label']} au centre {$stockAdded['centre_label']}::{$stockAdded['centre_adresse']}. <br>"
                . "La banque de réserve de vaccins au centre {$stockAdded['centre_label']}:{$stockAdded['centre_adresse']} stocke actuellement {$stockAdded['quantite']} dose(s) de vaccin {$stockAdded['vaccin_label']}. <br>"
                . "<h2>Voici la nouvelle liste de vaccins en stock: </h2></h3>");
                
            } else if ($stockAdded == -1) {
                echo("<h3 style='display: block;'>Vous avez ajouté $vaccin_add dose(s) de vaccin $vaccin_label au centre $centre_label:$centre_adresse. <br>"
                    . "La banque de réserve de vaccins au centre $centre_label::$centre_adresse stocke actuellement $vaccin_add dose(s) de vaccin $vaccin_label. <br>"
                    . "<h2>Voici la nouvelle liste de vaccins en stock: </h2></h3>");
            }
        }
        ?>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr style="background-color: #AA6C39">
                    <th scope="col">Vaccin</th>
                    <th scope="col">Centre de vaccination</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Quantité du vaccin en stock</th>
                </tr>
            </thead>

            <tbody>
                <?php
                if (!is_null($results)) {
                    // La liste des stocks est dans une variable $results
                    for ($i = 0; $i < count($results); $i++) {
                        printf("
                                <tr>
                                    <td>{$results[$i]['vaccin_label']}</td>
                                    <td>{$results[$i]['centre_label']}</td>
                                    <td>{$results[$i]['centre_adresse']}</td>
                                    <td>{$results[$i]['doses']}</td>
                                </tr>          
                        ");
                    }
                }
                ?>
            </tbody>
        </table>
        
        <button class="btn btn-primary" onclick="history.go(-1)" style="margin: 8px 0px">Page précédente</button>
    </div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>