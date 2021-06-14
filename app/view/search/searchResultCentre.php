<?php
include($root . '/app/controller/config.php');
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax">
        <div class="titre">
            Découvrez nos centres de vaccination...
        </div>
    </div>
    
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        
        if (count($results) == 0){
            echo ("<h4>Le centre que vous avez rentré n'existe pas. <br>
                        Essayez encore une fois.</h4>");
        } else {
        ?>

        <table class="table table-striped table-bordered">
            <thead>
                <tr style="background-color: #AA6C39">
                    <th scope="col">id</th>
                    <th scope="col">label</th>
                    <th scope="col">adresse</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                foreach ($results as $centre) { 
                    printf("<tr>
                                <td>{$centre->getId()}</td>
                                <td>{$centre->getLabel()}</td>
                                <td>{$centre->getAdresse()}</td>
                            </tr>");
                    }
                }
                ?>
            </tbody>
        </table>
        <button class="btn btn-primary" style="margin-bottom:7px" onclick="history.go(-1)">Page précédente</button>
    </div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
