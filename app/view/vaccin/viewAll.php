<!-- ----- début viewAll -->
<?php
include($root . '/app/controller/config.php');
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax">
        <div class="titre">
            Découvrez nos vaccins...
        </div>
    </div>
    
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        <form class="navbar-form navbar-right" role="search" method="get" action="router2.php" style="margin-bottom: 14px">
            <input type="hidden" name="action" value="searchVaccin">
            <div class="form-group">
                <input name="searching" type="text" class="form-control" size='44' placeholder="Rechercher par label...">
            </div>
            <button type="submit" class="btn btn-danger">Rechercher</button>
        </form>

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

<!-- ----- fin viewAll -->