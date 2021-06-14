<?php
include($root . '/app/controller/config.php');;
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class='parallax'>
        <div class='titre'>Suppression d'un patient ...</div>
    </div>
    
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>

        <div style="margin-bottom: 20px">
            <h3>Problème de suppression du patient. Il est probable qu'il soit présent dans la table des patients. <br>
                Voici donc la liste des patients actuelle : <br>
            </h3>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">nom</th>
                <th scope="col">prenom</th>
                <th scope="col">adresse</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // La liste des patients est dans une variable $results
            foreach ($results as $element) {
                printf("
                            <tr>
                                <td>{$element->getId()}</td>
                                <td>{$element->getNom()}</td>
                                <td>{$element->getPrenom()}</td>
                                <td>{$element->getAdresse()}</td>
                            </tr>          
                    ");
            }
            ?>
            </tbody>
        </table>
    </div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

</body>
