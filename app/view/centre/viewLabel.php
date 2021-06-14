<?php
include ($root . '/app/controller/config.php');
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
<div class="parallax parallax2">
    <div class="titre">
        Découvrez nos centres de vaccination...
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
            <label for="id">Centre de vaccination : </label> <select class="form-control" id='label' name='label' style="width: 120px">
                <?php
                foreach ($results as $center) {
                    echo ("<option>{$center['centre_label']} : {$center['centre_adresse']}</option>");
                }
                ?>
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
</div>

<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
