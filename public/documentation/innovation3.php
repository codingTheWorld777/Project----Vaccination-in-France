<!DOCTYPE html>
<?php include '../../app/view/fragment/fragmentHeader.html'; ?>
<body>
<div class="container">
    <?php
    include '../../app/view/fragment/fragmentMenu.html';
    ?>
    <div class="jumbotron3">
        <div class ='panel panel-success'>
            <div class="panel-heading"><h4 style="margin: 0px"><b>Tableau de bord COVID-19</b></h4></div>
            <div class="panel-body"> 
                <h4>Détail de cette amélioration: </h4>
                <p>Cette fonctionnalité permet de voir toutes les adresses (on peut remplacer les adresses par la ville ou le département) avec le nombre de patients affectés par le COVID-19. Selon moi, 
                    on devrait ajouter le département et la ville où le patient habite dans les bases des données pour pouvoir filtrer le nombre du patient par son adresse ou son département dans cette fonctionnalité.
                </p>
            </div>
        </div>
    </div>
</div>
<?php include '../../app/view/fragment/fragmentFooter.html'; ?>