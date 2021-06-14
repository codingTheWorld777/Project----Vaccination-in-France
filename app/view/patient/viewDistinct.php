<?php
include ($root . '/app/controller/config.php');
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax parallax2">
        <div class="titre">
            Liste des patients en attente ...
        </div>
    </div>
    
    <div class="container">
        <?php
        include $root.'/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        
        <h3>Evolution de COVID-19: </h3>
        
        <table class = "table table-striped table-bordered table-hover">
            <thead>
                <tr style="background-color: #d4edda;">
                    <th scope = "col">Liste sans doublon des addresses de patients</th>
                    <?php
                    if ($results1 != NULL) {
                        echo("<th scope = 'col'>Nombre de patients</th>"); 
                    } 
                    ?>
                </tr>
            </thead>
            
            <tbody>
                <?php
                // La liste des patients est dans une variable $results  
                $quantityByAddress = "";
                $count = 0;

                if ($results1 != NULL) $quantityByAddress = "<td>%d</td>";

                foreach ($results as $element) {
                    if ($results1 != NULL) {
                         printf("<tr><td>%s</td>$quantityByAddress</tr>", $element->getAdresse(), $results1[$count]);
                         $count++;
                    } else printf("<tr><td>%s</td></tr>", $element->getAdresse());
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

    </div>
</body>

