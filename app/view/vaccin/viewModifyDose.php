<!-- ----- début viewModifyDose -->
<?php
include($root . '/app/controller/config.php');
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax">
        <div class="titre">
            Modifiez la quantité d'une dose en ajoutant des nouvelles ...
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
        
        <form role="form" method='get' action='router2.php' style="margin-top: 8px;">
            <div class="form-group">
                <input type="hidden" name='action' value='vaccinUpdateDose'>
                <label for="label">vaccin_label : </label>
                <select class="form-control" id='label' name='label' style="width: 100px">
                    <?php
                    foreach ($results as $vaccin) {
                        $vaccinLabel = $vaccin->getLabel();
                        echo ("<option>$vaccinLabel</option>");
                    }
                    ?>
                </select>
                
                <label for="quantite" style="margin-top: 8px;">Nombre des doses ajoutées : </label> 
                <input type="number" id="quantite" name="quantite" value="1">
            </div>
            <button class="btn btn-primary" type="submit">Ajouter</button>
        </form>
    </div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

<!-- ----- fin viewModifyDose -->