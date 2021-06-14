<!-- ----- début viewSetRdv -->
<?php
include($root . '/app/controller/config.php');
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax">
        <div class="titre">
            Allez prendre un rendez-vous avec notre centre de vaccination ...
        </div>
    </div>
    
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        <form class="navbar-form navbar-right" role="search" method="get" action="router2.php" style="margin-bottom: 14px">
            <input type="hidden" name="action" value="searchVaccin">
            <div class="form-group">
                <input name="searching" type="text" class="form-control" size='44' placeholder="Rechercher vaccin par label...">
            </div>
            <button type="submit" class="btn btn-danger">Rechercher</button>
        </form>

        <table class="table table-striped table-bordered table-hover" style="margin-top: 14px">
            <thead>
                <tr style="background-color: #AA6C39">
                    <th scope="col">centre</th>
                    <th scope="col">adresse</th>
                    <th scope="col">vaccin</th>
                    <th scope="col">injection</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    if (!empty($results)) {
                       printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%d</td></tr>", $centre_label, $centre_adresse, $results[1], $injection); 
                    }
                ?>
            </tbody>
        </table>
        <?php 
            if ($results != -1) {
                if (!empty($results)) {
                    echo("<h3 style='margin-bottom: 20px; '>Vous avez réussi à prendre un rendez-vous au centre $centre_label. <br>"
                      . "Vous serez vacciné(e) le vaccin $results[1].</h3>");
                
                } else {
                    echo("<h3 style='margin-bottom: 20px; '>Vous avez déjà pris un rendez-vous. Veuillez revenir à la page d'accueil. <br></h3>");
                }
            } else {
                echo("<h3 style='margin-bottom: 20px; '>Le centre $centre_label n'a aucune vaccin de ve type. Veuillez attendre notre nouvelle nofitication.<br></h3>");
            }
        ?>
        <a href='router2.php?action=truc' class='btn btn-primary' style='margin-bottom:7px;' >Page accueil</a>
    </div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

<!-- ----- fin viewSetRdv -->