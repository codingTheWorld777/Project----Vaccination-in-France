<?php
include($root . '/app/controller/config.php');
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax parallax2">
        <div class="titre">
            Allez boire un verre ...
        </div>
    </div>
    
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        
        <h4 style='color: #5a5050; margin-bottom: 24px;'>Liste des patient avec les doses complètes: </h4>
     
        <table class='table table-striped table-bordered table-hover'>
            <thead>
                <tr style='background-color: #AA6C39'>
                    <th scope='col'>nom</th>
                    <th scope='col'>prénom</th>
                    <th scope='col'>nom de vaccin</th>
                    <th scope='col'>doses</th>
                    <th scope='col'>centre de vaccination</th>
                    <th scope='col'>adresse</th>
                    <th scope='col'>injection</th>
                </tr>
            </thead>

            <tbody>
                <?php
                if (!empty($results)) {
                    foreach ($results as $rdv) {
                        printf("
                            <tr>
                                <td>{$rdv['nom']}</td>
                                <td>{$rdv['prenom']}</td>
                                <td>{$rdv['vaccin_label']}</td>
                                <td>{$rdv['doses']}</td>
                                <td>{$rdv['centre_label']}</td>
                                <td>{$rdv['centre_adresse']}</td>
                                <td>{$rdv['injection']}</td>
                            </tr>    
                        ");
                    }           
                }
                ?>
            </tbody>
        </table>
        
        <button class='btn btn-primary' style='margin-bottom:7px;' onclick='history.go(-1)'>Page précédente</button>
        
    </div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>