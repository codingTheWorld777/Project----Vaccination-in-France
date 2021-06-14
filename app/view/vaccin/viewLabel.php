
<!-- ----- début viewId -->
<?php
include ($root . '/app/controller/config.php');
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax">
        <div class="titre">Découvrez nos vaccins...</div>
    </div>  
    
    <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentMenu.html';
      include $root . '/app/view/fragment/fragmentJumbotron.html';

      // $results contient un tableau avec la liste des clés.
      ?>

    <form role="form" method='get' action='router2.php'>
        <div class="form-group">
            <input type="hidden" name='action' value='<?php echo($target);?>'>
            <label for="label">Choisir un vaccin : </label> <select class="form-control" id='label' name='label' style="width: 100px">
                <?php
                foreach ($results as $label) {
                 echo ("<option>$label</option>");
                }
                ?>
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
    
  </div>

  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

  <!-- ----- fin viewId -->