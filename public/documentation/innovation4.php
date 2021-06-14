<!DOCTYPE html>
<?php include '../../app/view/fragment/fragmentHeader.html'; ?>
<body>
<div class="container">
    <?php
    include '../../app/view/fragment/fragmentMenu.html';
    ?>
    <div class="jumbotron3">
        <h3 class='text-primary'>Innovations supplémentaires:</h3>
        
        <div class ='panel panel-success'>
            <div class="panel-heading"><h4 style="margin: 0px"><b>La barre 'Recherche...'</b></h4></div>
            <div class="panel-body"> 
                <h4>Détail de cette fonctionnalité: </h4>
                <p>J'ai ajouté un controlleur, un modèle, et aussi une vue du type 'search' pour permettre au utilisateur de
                    chercher un vaccin/un centre/un patient selon son nom.
                </p>
            </div>
        </div>
        
        <div class ='panel panel-success'>
            <div class="panel-heading"><h4 style="margin: 0px"><b>Suppression d'un vaccin, d'un centre de vaccination, d'un patient ou d'un stock</b></h4></div>
            <div class="panel-body"> 
                <h4>Détail de cette fonctionnalité: </h4>
                <ul>
                    <li>
                        <p>Cette nouvelle fonctionnalité permettre aux utilisateurs de pouvoir supprimer un vaccin/un centre de vaccination/un stock.<br>
                        Si l'on veut supprimer un type de vaccin (ou un centre de vaccination ou tous les deux) mais la liste de stock comprend ce vaccin (ou ce centre de vaccination), 
                        le programme va supprimer tout d'abord le stock qui comprendre ce type de vaccin (ou ce centre de vaccination ou tous les deux), ensuite il va supprimer ce vaccin
                        (aussi le centre de vaccination) en respectant les contraintes de clé étrangère dans le langage SQL.
                        </p>
                    </li>
                    
                    <li>
                        <p>De même, si l'on veut supprimer un stock mais il y a un patient qui aura un rendez-vous avec un centre de vaccination pour vacciner un type de vaccin, 
                        le programme va également supprimer tout d'abord son rendez-vous selon le nom du centre de vaccination et le nom du vaccin et enfin il va supprimer ce stock.
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class ='panel panel-success'>
            <div class="panel-heading"><h4 style="margin: 0px"><b>Amélioration de layout du WEB</b></h4></div>
            <div class="panel-body"> 
                <h4>Détail de cette amélioration: </h4>
                <p>J'ai réécrit les codes dans perso_css.css pour améliorer l'interface du WEB. J'ai ajouté quelques nouveaux components/layouts
                comme 'parallax, parallax1, parallax2, jumbotron2, jumbotron3' pour découper le WEB à chaque partie différente. Le WEB comprend maintenant
                les layouts séparés comme vous voyez.
                </p>
            </div>
        </div>
        
        <div class ='panel panel-success'>
            <div class="panel-heading"><h4 style="margin: 0px"><b>Changement du background à chaque 4 secondes</b></h4></div>
            <div class="panel-body"> 
                <h4>Détail de cette fonctionnalité: </h4>
                <p>J'ai ajouté une partie écrite en Javascript pour le changement du background. En utilisant Javascript DOM,
                    le WEB peut changer son background chaque 4 secondes.
                </p>
            </div>
        </div>
    </div>
</div>
<?php include '../../app/view/fragment/fragmentFooter.html'; ?>