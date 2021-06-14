<?php
include($root . '/app/controller/config.php');
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax">
        <div class="titre">
            Supression d'un vaccin
        </div>
    </div>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.html';
    include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>

    <div style="margin-bottom: 20px">
        <h3>Le vaccin <?php echo $label_vaccinDeleted ?> a bien été supprimé.
            <br> Voici la nouvelle liste des vaccins : <br>
        </h3>
    </div>

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr style="background-color: #AA6C39">
                <th scope="col">id</th>
                <th scope="col">label</th>
                <th scope="col">doses</th>
            </tr>
        </thead>
        
        <tbody>
            <?php
            // La liste des vaccins est dans une variable $results
            foreach ($results as $element) {
                printf("<tr><td>%d</td><td>%s</td><td>%d</td></tr>", $element->getId(), $element->getLabel(), $element->getDoses());
            }
            ?>
        </tbody>
    </table>
</div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
