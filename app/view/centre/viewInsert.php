<?php
include ($root . '/app/controller/config.php');
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax parallax2">
        <div class="titre">
            Vous voulez ajouter un nouveau centre de vaccination ? <br>
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
                <input type="hidden" name='action' value='centreCreated'>
                <label for="id">label : </label><input type="text" name='label' size='45' value=''>                           
                <label for="id">adresse : </label><input type="text" name='adresse' size='35' value=''>
            </div>
            <button class="btn btn-primary" type="submit">Go</button>
        </form>
        
    </div>
    
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
