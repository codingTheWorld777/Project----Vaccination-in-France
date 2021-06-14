<?php
include($root . '/app/controller/config.php');
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax">
        <div class="titre">
            Liste des patients en attente...
        </div>
    </div>
    
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        
        if (count($results) == 0){
            echo ("<h4>Le nom du patient que vous avez rentré n'existe pas. <br>
                        Essayez encore une fois.</h4>");
        } else {
        ?>

        <table class="table table-striped table-bordered">
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
                foreach ($results as $patient) { 
                    printf("<tr>
                                <td>{$patient->getId()}</td>
                                <td>{$patient->getNom()}</td>
                                <td>{$patient->getPrenom()}</td>
                                <td>{$patient->getAdresse()}</td>
                            </tr>");
                    }
                }
                ?>
            </tbody>
        </table>
        <button class="btn btn-primary" style="margin-bottom:7px" onclick="history.go(-1)">Page précédente</button>
    </div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
