<?php
include($root . '/app/controller/config.php');
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax parallax2">
        <div class="titre">
            Liste des rendez-vous ...
        </div>
    </div>
    
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        
        echo("<h4 style='color: #5a5050; margin-bottom: 24px;'>Liste des rendez-vous disponibles: </h4>");
        ?>
     
        <table class='table table-striped table-bordered table-hover'>
            <thead>
                <tr style='background-color: #AA6C39'>
                    <th scope='col'>nom</th>
                    <th scope='col'>prénom</th>
                    <th scope='col'>centre de vaccination</th>
                    <th scope='col'>adresse</th>
                    <th scope='col'>injection</th>
                    <th scope='col'>nom de vaccin</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($results as $rdv) {
                    printf("
                        <tr>
                            <td>{$rdv['nom']}</td>
                            <td>{$rdv['prenom']}</td>
                            <td>{$rdv['centre_label']}</td>
                            <td>{$rdv['centre_adresse']}</td>
                            <td>{$rdv['injection']}</td>
                            <td>{$rdv['vaccin_label']}</td>    
                        </tr>    
                    ");
                }
                ?>
            </tbody>
        </table>
        
    </div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>