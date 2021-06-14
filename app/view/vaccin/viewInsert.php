
<!-- ----- début viewInsert -->
 
<?php
include ($root . '/app/controller/config.php');
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax">
        <div class="titre"><br>Ajoutez un vaccin à notre centre de vaccination!</div>
    </div>
    
    <div class="container">
        <?php
          include $root . '/app/view/fragment/fragmentMenu.html';
          include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?> 

        <form role="form" method='get' action='router2.php'>
            <div class="form-group">
                <input type="hidden" name='action' value='vaccinCreated'>        
                <label for="id">label : </label><input type="text" name='label' size='75' value=''>                           
                <label for="id">doses : </label><input type="text" name='doses' value='2'>            
            </div>
            <button class="btn btn-primary" type="submit">Go</button>
        </form>
        
      </div>
 <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

<!-- ----- fin viewInsert -->



