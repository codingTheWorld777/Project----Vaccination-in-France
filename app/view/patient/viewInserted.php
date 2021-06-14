
<!-- ----- début viewInserted -->
<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
          include $root . '/app/view/fragment/fragmentMenu.html';
          include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>

        <!-- ===================================================== -->
        <?php
            if (!empty($id)) {
                echo ("<h3>Le nouveau patient a été ajouté </h3>");
                echo("<ul>");
                echo ("<li>id = " . $id . "</li>");
                echo ("<li>nom = " . $_GET['nom'] . "</li>");
                echo ("<li>prenom = " . $_GET['prenom'] . "</li>");
                echo ("<li>adresse = " . $_GET['adresse'] . "</li>");
                echo("</ul>");
                
                echo("<h3>Voici la nouvelle liste des patients: </h3>");
                echo("
                <table class='table table-striped table-bordered table-hover'>
                    <thead>
                        <tr style='background-color: #AA6C39'>
                            <th scope='col'>id</th>
                            <th scope='col'>nom</th>
                            <th scope='col'>prenom</th>
                            <th scope='col'>adresse</th>
                        </tr>
                    </thead>

                    <tbody>");
                        // La liste des vins est dans une variable $results
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
                echo(
                    "</tbody>
                </table>");  

            } else {
                echo ("<h3>Problème d'insertion du Patient.</h3>");
                echo ("<h3 style='color:red';>Veuillez vérifier toutes les infos du patient dans le formulaire ont été bien renseignées.</h3>");
            }
            
        ?>
        
        <button class="btn btn-primary" style="margin-bottom:7px;" onclick="history.go(-1)">Page précédente</button>
    </div>    
 <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
<!-- ----- fin viewInserted -->    

    
    