<?php
include($root . '/app/controller/config.php');
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax parallax2">
        <div class="titre">
            Liste des patients en attente ...
        </div>
    </div>
    
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
     
        <form role="form" method='get' action='router2.php'>
            <div class="form-group">
                <input type="hidden" name='action' value='<?php echo($target);?>'>
                <label for="id">View patient : </label> 
                <select class="form-control" id='patientInfo' name='patientInfo' style="width: 140px">
                    <?php
                    foreach ($results as $patient) {
                        echo ("<option>{$patient['id']} : {$patient['nom']} : {$patient['prenom']} : {$patient['adresse']}</option>");
                    }
                    ?>
                </select>
            </div>
            
            <button class="btn btn-primary" type="submit">Submit form</button>
        </form>
    </div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>