<?php
include ($root . '/app/controller/config.php');
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax parallax2">
        <div class="titre">
            Vous voulez ajouter un nouveau patient ? <br>
            Allez-y !
        </div>
    </div>
    
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>

        <form role="form" method='get' action='router2.php'>
            <div class="form-group">
                <input type="hidden" name='action' value='patientCreated'>
                <label for="id">nom : </label><input type="text" name='nom' size='45' value='Lennon'>
                <label for="id">prenom : </label><input type="text" name='prenom' size='45' value='John'>
                <label for="id">adresse : </label><input type="text" name='adresse' size='35' value='Paris'>
            </div>
            <button class="btn btn-primary" type="submit">Go</button>
        </form>
        
    </div>
    
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
