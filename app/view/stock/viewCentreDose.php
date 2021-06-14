<?php
include($root . '/app/controller/config.php');
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax parallax2">
        <div class="titre">
            Stock des vaccins ...
        </div>
    </div>
    
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        
        <form class="navbar-form navbar-right" role="search" method="get" action="router2.php" style="margin-bottom: 20px">
            <input type="hidden" name="action" value="searchStock">
            <div class="form-group">
                <input name="searching" type="text" class="form-control" size='44' placeholder="Rechercher par le label du vaccin...">
            </div>
            <button type="submit" class="btn btn-danger">Rechercher</button>
        </form>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr style="background-color: #AA6C39">
                    <th scope="col">Centre de vaccination</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Quantité du vaccin en stock</th>
                </tr>
            </thead>

            <tbody>
                <?php
                // La liste des stocks est dans une variable $results
                for ($i = 0; $i < count($stockCenters); $i++) {
                    printf("
                            <tr>
                                <td>{$stockCenters[$i]['label']}</td>
                                <td>{$stockCenters[$i]['adresse']}</td>
                                <td>{$numberOfDosesByCenter[$i]}</td>
                            </tr>          
                    ");
                }
                ?>
            </tbody>
        </table>
        
        <button class="btn btn-primary" onclick="history.go(-1)" style="margin: 8px 0px">Page précédente</button>
    </div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

