<?php
include($root . '/app/controller/config.php');;
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax parallax2">
        <div class="titre">
            Liste des patients en attente...
        </div>
    </div>
    
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        <form class="navbar-form navbar-right" role="search" method="get" action="router2.php" style="margin-bottom: 14px">
            <input type="hidden" name="action" value="searchPatient">
            <div class="form-group">
                <input name="searching" type="text" class="form-control" size='44' placeholder="Rechercher par nom du patient...">
            </div>
            <button type="submit" class="btn btn-danger">Rechercher</button>
        </form>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr style="background-color: #AA6C39">
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

