<?php
include($root . '/app/controller/config.php');;
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.html';
    include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>

    <div style="margin-bottom: 20px">
        <h3>Problème de suppression du centre. Il est probable qu'il soit présent dans la table des stocks ou des rendez-vous. <br>
            Voici donc la liste des centres actuelle : <br>
        </h3>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">label</th>
            <th scope="col">adresse</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // La liste des centres est dans une variable $results
        foreach ($results as $element) {
            printf("
                        <tr>
                            <td>{$element->getId()}</td>
                            <td>{$element->getLabel()}</td>
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
