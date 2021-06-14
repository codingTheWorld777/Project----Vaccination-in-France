<?php
include($root . '/app/controller/config.php');
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax parallax2">
        <div class="titre">
            Suppression d'un stock ...
        </div>
    </div>
    
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        
        <?php
        if ($delete_operation) {
            echo("<h2 style='display: block;'>Le vaccin $vaccin_label au centre $centre_label a été supprimé. <br>"
                . "<h3>Voici la nouvelle liste de stock: </h3></h2>");
        } else {
            echo("<h2 style='display: block;'>Le vaccin $vaccin_label au centre $centre_label n'existe pas dans le stock. <br>"
                . "<h3>Voici la liste de stock: </h3></h2>");
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