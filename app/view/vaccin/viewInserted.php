
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
            echo ("<h3>Le nouveau vaccin a été ajouté </h3>");
            echo("<ul>");
            echo ("<li>id = " . $id . "</li>");
            echo ("<li>label = " . $_GET['label'] . "</li>");
            echo ("<li>doses = " . $_GET['doses'] . "</li>");
            echo("</ul>");
            
            echo("<h3>Voici la nouvelle liste des vaccins:</h3>");
            
            echo("
            <table class='table table-striped table-bordered table-hover'>
                <thead>
                    <tr style='background-color: #AA6C39'>
                        <th scope='col'>id</th>
                        <th scope='col'>label</th>
                        <th scope='col'>doses</th>
                    </tr>
                </thead>

                <tbody>");
                    // La liste des vaccins est dans une variable $results
                    foreach ($results as $element) {
                        printf("<tr><td>%d</td><td>%s</td><td>%d</td></tr>", $element->getId(), $element->getLabel(), $element->getDoses());
                    }
            echo(
                "</tbody>
            </table>");    
            
        } else {
            echo ("<h3>Problème d'insertion du Vaccin.</h3>");
            echo ("<h3 style='color:red';>Veuillez vérifier toutes les infos du vaccin dans le formulaire ont été bien renseignées ou le nom du vaccin est dupliqué.</h3>");
        }

        ?>
        
        <button class="btn btn-primary" style="margin-bottom:7px;" onclick="history.go(-1)">Page précédente</button>
    </div>
<?php include $root . '/app/view/fragment/fragmentFooter.html';?>
<!-- ----- fin viewInserted -->    

    
    