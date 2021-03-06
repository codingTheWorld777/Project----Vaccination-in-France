<!-- ----- début viewUpdateDose -->
<?php
include($root . '/app/controller/config.php');
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax">
        <div class="titre">
            Mise à jour d'un vaccin ...
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
                <input name="searching" type="text" class="form-control" size='44' placeholder="Rechercher par label...">
            </div>
            <button type="submit" class="btn btn-danger">Rechercher</button>
        </form>
        
        <br><br>
        
        <div style="margin-bottom: 20px">
            <h3>Le vaccin <?php echo $vaccin_label ?> a bien été modifié.
                <br> Voici la nouvelle liste des vaccins : <br>
            </h3>
        </div>
        
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr style="background-color: #AA6C39">
                    <th scope="col">id</th>
                    <th scope="col">label</th>
                    <th scope="col">doses</th>
                </tr>
            </thead>

            <tbody>
                <?php
                // La liste des vaccins est dans une variable $results
                foreach ($results as $element) {
                    printf("<tr><td>%d</td><td>%s</td><td>%d</td></tr>", $element->getId(), $element->getLabel(), $element->getDoses());
                }
                ?>
            </tbody>
        </table>

        <button class="btn btn-primary" style="margin-bottom:7px;" onclick="history.go(-1)">Page précédente</button>
    </div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

<!-- ----- fin viewUpdateDose -->