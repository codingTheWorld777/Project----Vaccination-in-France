<!DOCTYPE html>
<?php include '../../app/view/fragment/fragmentHeader.html'; ?>
<body>
<div class="container">
    <?php
    include '../../app/view/fragment/fragmentMenu.html';
    ?>
    <div class="jumbotron3"> 
        <div class ='panel panel-success'>
            <div class="panel-heading"><h4 style="margin: 0px"><b>L'itinéraire au centre de vaccination</b></h4></div>
            <div class="panel-body"> 
                <h4>Détail de cette amélioration: </h4>
                <p>Cette fonctionnalité permet au patient de trouver l'itinéraire de son adresse au centre de vaccination. 
                    La fenêtre de l'itinéraire va gérer automatiquement dans le nouveau onglet par le code Javascript. Si la
                    fenêtre est bloquée, l'utilisateur peut cliquer sur le lien affiché pour voir son itinéraire.
                </p>
            </div>
        </div>
    </div>
</div>
<?php include '../../app/view/fragment/fragmentFooter.html'; ?>