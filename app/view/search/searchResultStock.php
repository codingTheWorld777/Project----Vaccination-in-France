<?php
include($root . '/app/controller/config.php');
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax">
        <div class="titre">
            Vaccins en stock ...
        </div>
    </div>
    
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        
        if (count($results) == 0){
            echo ("<h4>Le nom du vaccin que vous avez rentré n'existe pas. <br>
                        Essayez encore une fois.</h4>");
        } else {
        ?>

        <table class="table table-striped table-bordered">
            <thead>
                <tr style="background-color: #AA6C39">
                    <th scope="col">Vaccin</th>
                    <th scope="col">Centre</th>
                    <th scope="col">Nombre des doses</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                foreach ($results as $stock) { 
                    printf("<tr>
                                <td>{$stock['vaccin_label']}</td>
                                <td>{$stock['centre_label']}</td>
                                <td>{$stock['quantite']}</td>
                            </tr>");
                    }
                }
                ?>
            </tbody>
        </table>
        <button class="btn btn-primary" style="margin-bottom:7px" onclick="history.go(-1)">Page précédente</button>
    </div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
